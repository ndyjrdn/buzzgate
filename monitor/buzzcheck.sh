#!/bin/bash

echo "🔎 Buzzcheck v0.1 — Status Scan Initiated"

# Docker checks
echo "→ Docker containers:"
docker ps --format "  • {{.Names}} - {{.Status}}"

# Pi-hole checks
echo "→ Pi-hole health:"
curl -s http://localhost:8080/admin/api.php?status | grep -q '"status":"enabled"' && \
  echo "  ✅ Pi-hole is enabled" || echo "  ❌ Pi-hole is disabled"
  
echo "→ WAN Speed:"
jq -r '" • Download: \(.download.bandwidth * 8 / 1000000 | round) Mbps\n • Upload: \(.upload.bandwidth * 8 / 1000000 | round) Mbps\n • Ping: \(.ping.latency) ms"' /home/andy/buzzgate/monitor/speedtest/speedtest.json

# Port checks
echo "→ Port listening:"
sudo netstat -tulpn | grep -E ":53|:80|:8080"

# SSH check (optional)
ssh -T git@github.com &>/dev/null && \
  echo "  🔐 SSH: GitHub access OK" || echo "  🔐 SSH: Issue with GitHub key"

echo "✅ Buzzcheck complete"
