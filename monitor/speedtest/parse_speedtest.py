#!/usr/bin/env python3

import json
from datetime import datetime

with open("/home/andy/buzzgate/monitor/speedtest/speedtest.json") as f:
    data = json.load(f)

download_mbps = round(data["download"]["bandwidth"] * 8 / 1e6, 2)
upload_mbps = round(data["upload"]["bandwidth"] * 8 / 1e6, 2)
ping_ms = round(data["ping"]["latency"], 2)
jitter_ms = round(data["ping"]["jitter"], 2)
server = data["server"]["name"]
isp = data["isp"]
external_ip = data["interface"]["externalIp"]
timestamp = datetime.utcnow().isoformat()

print(f"📡 Speedtest @ {timestamp}")
print(f" • ISP: {isp}")
print(f" • Server: {server}")
print(f" • External IP: {external_ip}")
print(f" • Download: {download_mbps} Mbps")
print(f" • Upload: {upload_mbps} Mbps")
print(f" • Ping: {ping_ms} ms (Jitter: {jitter_ms} ms)")
