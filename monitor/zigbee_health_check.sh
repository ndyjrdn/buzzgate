#!/bin/bash
# Reads Zigbee2MQTT's per-device availability (enabled 2026-08-21) directly off
# the retained zigbee2mqtt/+/availability MQTT topics - not through Home
# Assistant - since HA just folds that into each entity's own state rather
# than exposing a simple online/offline list anywhere. Writes a Prometheus
# textfile for node-exporter to pick up (Grafana health panel), and with
# --notify also sends a Pushover summary of any offline devices.
set -euo pipefail

REPO_DIR="/home/andy/buzzgate"
MONITOR_DIR="$REPO_DIR/monitor"
TEXTFILE_DIR="$MONITOR_DIR/textfile_collector"
TEXTFILE_TMP="$TEXTFILE_DIR/zigbee_health.prom.tmp"
TEXTFILE_OUT="$TEXTFILE_DIR/zigbee_health.prom"
PUSHOVER_USER_KEY_FILE="$REPO_DIR/compose/alertmanager/.pushover_user_key"
PUSHOVER_TOKEN_FILE="$REPO_DIR/compose/alertmanager/.pushover_token"
MQTT_CONTAINER="cy-mosquitto-z2m"
Z2M_CONFIG="$REPO_DIR/compose/zigbee2mqtt/configuration.yaml"
RUN_LOG="$MONITOR_DIR/zigbee_health_check.log"

log() { echo "[$(date -Is)] $*" >> "$RUN_LOG"; }

# Zigbee2MQTT groups (e.g. "hallway", "entryway") get an availability topic
# too, but they're virtual - no radio of their own - so they'd always show as
# permanently offline and pollute the count/digest with fake noise. Skip them.
GROUP_NAMES=$(python3 -c "
import yaml
cfg = yaml.safe_load(open('$Z2M_CONFIG'))
for g in cfg.get('groups', {}).values():
    print(g['friendly_name'])
")

RAW=$(docker exec "$MQTT_CONTAINER" sh -c \
  "mosquitto_sub -h localhost -t 'zigbee2mqtt/+/availability' -W 5 -v 2>/dev/null" || true)

if [ -z "$RAW" ]; then
  log "ERROR: no availability messages received from $MQTT_CONTAINER"
  exit 1
fi

mkdir -p "$TEXTFILE_DIR"
{
  echo "# HELP zigbee_device_availability Zigbee2MQTT device availability (1=online, 0=offline)"
  echo "# TYPE zigbee_device_availability gauge"
} > "$TEXTFILE_TMP"

TOTAL=0
ONLINE=0
OFFLINE_NAMES=()

while IFS= read -r line; do
  [ -z "$line" ] && continue
  topic="${line%% *}"
  payload="${line#* }"
  device="${topic#zigbee2mqtt/}"
  device="${device%/availability}"

  if grep -qxF "$device" <<< "$GROUP_NAMES"; then
    continue
  fi

  state=$(echo "$payload" | python3 -c "import json,sys; print(json.load(sys.stdin).get('state','unknown'))" 2>/dev/null || echo "unknown")

  val=0
  [ "$state" = "online" ] && val=1

  echo "zigbee_device_availability{device=\"$device\"} $val" >> "$TEXTFILE_TMP"
  TOTAL=$((TOTAL + 1))
  if [ "$val" -eq 1 ]; then
    ONLINE=$((ONLINE + 1))
  else
    OFFLINE_NAMES+=("$device")
  fi
done <<< "$RAW"

mv "$TEXTFILE_TMP" "$TEXTFILE_OUT"
log "checked $TOTAL devices, $ONLINE online, ${#OFFLINE_NAMES[@]} offline"

if [ "${1:-}" = "--notify" ]; then
  if [ ! -f "$PUSHOVER_USER_KEY_FILE" ] || [ ! -f "$PUSHOVER_TOKEN_FILE" ]; then
    log "ERROR: missing Pushover credential file(s), skipping notify"
    exit 1
  fi

  if [ "${#OFFLINE_NAMES[@]}" -eq 0 ]; then
    MESSAGE="All $TOTAL Zigbee devices online."
  else
    MESSAGE="$ONLINE/$TOTAL Zigbee devices online. Offline: $(IFS=', '; echo "${OFFLINE_NAMES[*]}")"
  fi

  curl -s \
    --form-string "token=$(cat "$PUSHOVER_TOKEN_FILE")" \
    --form-string "user=$(cat "$PUSHOVER_USER_KEY_FILE")" \
    --form-string "title=Zigbee Daily Health Check" \
    --form-string "message=$MESSAGE" \
    --form-string "priority=0" \
    https://api.pushover.net/1/messages.json >> "$RUN_LOG" 2>&1
  log "sent daily digest: $MESSAGE"
fi
