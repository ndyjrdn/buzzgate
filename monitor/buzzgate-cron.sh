#!/bin/bash
# buzzgate-cron.sh

echo "🕰️ Buzzgate Cron Manager"

CRON_PATH="/home/andy/buzzgate/monitor/speedtest"
CRON_JOB="*/30 * * * * $CRON_PATH/speedtest.sh && $CRON_PATH/parse_speedtest.py"

case "$1" in
  install)
    echo "📌 Installing cron job..."
    (crontab -l 2>/dev/null; echo "$CRON_JOB") | crontab -
    echo "✅ Cron job installed:"
    echo "$CRON_JOB"
    ;;
  remove)
    echo "🧹 Removing cron job..."
    crontab -l | grep -v "$CRON_PATH/speedtest.sh" | crontab -
    echo "✅ Cron job removed."
    ;;
  test)
    echo "🧪 Running speedtest manually..."
    bash "$CRON_PATH/speedtest.sh"
    python3 "$CRON_PATH/parse_speedtest.py"
    ;;
  list)
    echo "📋 Current cron jobs:"
    crontab -l
    ;;
  *)
    echo "Usage: $0 {install|remove|test|list}"
    ;;
esac
