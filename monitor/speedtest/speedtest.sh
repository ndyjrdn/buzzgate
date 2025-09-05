#!/bin/bash
# speedtest.sh

timestamp=$(date +"%Y-%m-%d_%H-%M-%S")
output="/home/andy/buzzgate/monitor/speedtest/speedtest.json"

speedtest --accept-license --accept-gdpr -f json > "$output"
