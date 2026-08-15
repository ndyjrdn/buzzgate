#!/bin/bash
# Checks the live Home Assistant log for new errors/warnings/disconnects every run,
# asks Claude (no tool access — pure text in, structured JSON out) to summarize them
# and pick which failed config entries are safe to reload, then performs the actual
# HA API calls (reload + notify) itself. The LLM never sees the HA token and can only
# trigger a reload for an entry HA itself already reports as failed.
set -euo pipefail

REPO_DIR="/home/andy/buzzgate"
CLAUDE_BIN="/home/andy/.local/bin/claude"
MONITOR_DIR="$REPO_DIR/monitor"
HA_URL="http://localhost:8123"
LOG_FILE="$REPO_DIR/compose/homeassistant/home-assistant.log"
ENV_FILE="$MONITOR_DIR/.ha_log_monitor.env"
OFFSET_FILE="$MONITOR_DIR/.ha_log_check_offset"
SLICE_FILE="$MONITOR_DIR/.ha_log_check_slice.tmp"
RUN_LOG="$MONITOR_DIR/ha_log_check.log"

log() { echo "[$(date -Is)] $*" >> "$RUN_LOG"; }

if [ ! -f "$ENV_FILE" ]; then
  log "ERROR: missing $ENV_FILE (expects HA_TOKEN=...)"
  exit 1
fi
# shellcheck disable=SC1090
source "$ENV_FILE"
if [ -z "${HA_TOKEN:-}" ]; then
  log "ERROR: HA_TOKEN not set in $ENV_FILE"
  exit 1
fi

AUTH_HEADER="Authorization: Bearer $HA_TOKEN"

# --- 1. Capture only the log lines written since the last run (rotation-safe) ---
CUR_SIZE=$(stat -c%s "$LOG_FILE")
LAST_OFFSET=0
[ -f "$OFFSET_FILE" ] && LAST_OFFSET=$(cat "$OFFSET_FILE")
[ "$LAST_OFFSET" -gt "$CUR_SIZE" ] && LAST_OFFSET=0   # log rotated since last run

tail -c +"$((LAST_OFFSET + 1))" "$LOG_FILE" > "$SLICE_FILE"
echo "$CUR_SIZE" > "$OFFSET_FILE"   # advance pointer now so a failed run doesn't reprocess forever

# --- 2. Filter to lines worth looking at ---
FILTERED=$(grep -Ei 'ERROR|WARNING|disconnect|unavailable|unreachable|unable to connect|connection lost|timed out|timeout|reconnect|not ready|setup failed|failed setup' "$SLICE_FILE" || true)
rm -f "$SLICE_FILE"

if [ -z "$FILTERED" ]; then
  log "No error/warning/disconnect lines in this window ($LAST_OFFSET -> $CUR_SIZE bytes). Skipping."
  exit 0
fi

# Cap what we send to the model (cost/context control)
FILTERED_TRUNC=$(echo "$FILTERED" | tail -c 20000)

# --- 3. Ask HA which config entries are currently failed ---
# Entries with source "ignore" were deliberately dismissed by the user (e.g. a
# discovered device intentionally not set up because another integration owns
# the hardware) — HA never attempts to load them, so they're not a failure.
FAILED_ENTRIES=$(curl -s -H "$AUTH_HEADER" "$HA_URL/api/config/config_entries/entry" \
  | jq -c '[.[] | select(.state != "loaded" and .source != "ignore") | {entry_id, title, domain, state}]' 2>/dev/null || echo "[]")

# --- 4. Analysis only — no tool access, so the token is never exposed to the model ---
SCHEMA='{"type":"object","properties":{"has_issues":{"type":"boolean"},"summary":{"type":"string"},"entries_to_reload":{"type":"array","items":{"type":"string"}},"notification_message":{"type":"string"}},"required":["has_issues","summary","entries_to_reload","notification_message"]}'

PROMPT=$(cat <<EOF
You are reviewing a slice of Home Assistant's log for a homelab. Identify real
issues (errors, warnings, integration disconnects/reconnects, timeouts,
entities going unavailable). Ignore routine noise (deprecation notices,
one-off transient reconnects that immediately recovered).

Log lines (may include duplicates/noise — deduplicate similar messages and
report counts):
---
$FILTERED_TRUNC
---

Home Assistant config entries currently NOT in a "loaded" state (ground truth
from the HA API, not from the log):
$FAILED_ENTRIES

Task:
1. Summarize real findings in plain language, deduplicated, with rough counts.
2. In "entries_to_reload", list ONLY entry_id values copied verbatim from the
   list above, for entries whose failure is clearly reflected in the log
   lines and where a config entry reload is a reasonable, safe first step.
   Leave it empty if nothing above looks reload-worthy, or if the log shows
   a broader problem (e.g. a whole broker/integration down) where reloading
   a single entry won't help.
3. In "notification_message", write the message body for a phone notification:
   what was found, and for anything NOT in entries_to_reload, a concrete
   suggestion for what the owner should check or do. Keep it under 800
   characters, no markdown.
4. Set "has_issues" to true if you found anything worth surfacing at all
   (even if entries_to_reload is empty).
EOF
)

RESPONSE=$("$CLAUDE_BIN" -p "$PROMPT" \
  --output-format json \
  --tools "" \
  --model claude-sonnet-5 \
  --json-schema "$SCHEMA" 2>>"$RUN_LOG") || {
    log "ERROR: claude analysis call failed"
    exit 1
  }

HAS_ISSUES=$(echo "$RESPONSE" | jq -r '.structured_output.has_issues // false')
SUMMARY=$(echo "$RESPONSE" | jq -r '.structured_output.summary // ""')
NOTIF_MSG=$(echo "$RESPONSE" | jq -r '.structured_output.notification_message // ""')
RELOAD_IDS=$(echo "$RESPONSE" | jq -r '.structured_output.entries_to_reload // [] | .[]' 2>/dev/null || true)

log "Findings: $SUMMARY"

if [ "$HAS_ISSUES" != "true" ]; then
  log "Model found nothing notification-worthy. Skipping."
  exit 0
fi

# --- 5. Only reload entries that both the model proposed AND HA itself lists as failed ---
VALID_FAILED_IDS=$(echo "$FAILED_ENTRIES" | jq -r '.[].entry_id')
ACTIONS_TAKEN=""
for entry_id in $RELOAD_IDS; do
  if echo "$VALID_FAILED_IDS" | grep -qx "$entry_id"; then
    TITLE=$(echo "$FAILED_ENTRIES" | jq -r --arg id "$entry_id" '.[] | select(.entry_id == $id) | .title')
    HTTP_CODE=$(curl -s -o /dev/null -w "%{http_code}" -X POST \
      -H "$AUTH_HEADER" "$HA_URL/api/config/config_entries/entry/$entry_id/reload")
    if [ "$HTTP_CODE" = "200" ]; then
      log "Reloaded config entry $entry_id ($TITLE): success"
      ACTIONS_TAKEN="${ACTIONS_TAKEN}Reloaded '$TITLE' — succeeded.\n"
    else
      log "Reloaded config entry $entry_id ($TITLE): HTTP $HTTP_CODE"
      ACTIONS_TAKEN="${ACTIONS_TAKEN}Tried reloading '$TITLE' — failed (HTTP $HTTP_CODE), needs manual look.\n"
    fi
  else
    log "WARNING: model proposed entry_id $entry_id not in current failed-entries list, skipping reload"
  fi
done

FULL_MESSAGE="$NOTIF_MSG"
if [ -n "$ACTIONS_TAKEN" ]; then
  FULL_MESSAGE="$FULL_MESSAGE

Actions taken:
$(echo -e "$ACTIONS_TAKEN")"
fi

# --- 6. Notify: persistent notification in the HA UI + push to all mobile_app targets ---
curl -s -X POST -H "$AUTH_HEADER" -H "Content-Type: application/json" \
  -d "$(jq -n --arg title "HA Log Check" --arg msg "$FULL_MESSAGE" '{title: $title, message: $msg, notification_id: "ha_log_check"}')" \
  "$HA_URL/api/services/persistent_notification/create" > /dev/null

# Only Andy's device — this job used to fan out to every registered phone
# in the household during testing, which is more noise than intended.
MOBILE_SERVICES="mobile_app_dad"

for svc in $MOBILE_SERVICES; do
  curl -s -X POST -H "$AUTH_HEADER" -H "Content-Type: application/json" \
    -d "$(jq -n --arg title "HA Log Check" --arg msg "$FULL_MESSAGE" '{title: $title, message: $msg}')" \
    "$HA_URL/api/services/notify/$svc" > /dev/null
  log "Sent mobile notification via notify.$svc"
done

log "Notification sent. has_issues=$HAS_ISSUES reloads_attempted=$(echo "$RELOAD_IDS" | wc -w)"
