#!/usr/bin/env python3

import json
from datetime import datetime, timezone
from influxdb_client import InfluxDBClient, Point
from influxdb_client.client.write_api import SYNCHRONOUS

# Load speedtest result
with open("/home/andy/buzzgate/monitor/speedtest/speedtest.json") as f:
    data = json.load(f)

# Extract metrics
download = round(data["download"]["bandwidth"] * 8 / 1e6, 2)
upload = round(data["upload"]["bandwidth"] * 8 / 1e6, 2)
ping = round(data["ping"]["latency"], 2)
jitter = round(data["ping"]["jitter"], 2)
server = data["server"]["name"]
isp = data["isp"]
external_ip = data["interface"]["externalIp"]

# InfluxDB config
bucket = "buzzgate_monitor"
org = "buzzgate"
token = "hfqlvolr8DFKXcl3J7-f3KR99o5Cz4ujzEraDzktzkXFK3qiN8QsrBEABYJnuFSM4GBCDZmiLdhMDSqydjThxg=="
url = "http://cy:8086"

# Push to InfluxDB
client = InfluxDBClient(url=url, token=token, org=org)
write_api = client.write_api(write_options=SYNCHRONOUS)

# Convert MB/s to Mbps
download_mbps = download
upload_mbps = upload 

point = (
    Point("speedtest")
    .tag("server", server)
    .tag("isp", isp)
    .tag("external_ip", external_ip)
    .field("download_mbps", download_mbps)
    .field("upload_mbps", upload_mbps)
    .field("ping_ms", ping)
    .field("jitter_ms", jitter)
    .time(datetime.now(timezone.utc))
)
write_api.write(bucket=bucket, org=org, record=point)
print("✅ Speedtest pushed to InfluxDB.")
