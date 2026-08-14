#!/bin/bash
# Requests a fresh Zigbee2MQTT coordinator backup so compose/zigbee2mqtt/coordinator_backup.json
# doesn't go stale between z2m restarts. z2m already backs up on every startup automatically -
# this covers the gap for an abrupt power loss with no clean restart in between.
set -euo pipefail

docker exec cy-mosquitto-z2m mosquitto_pub -h localhost -t 'zigbee2mqtt/bridge/request/backup' -m ''
