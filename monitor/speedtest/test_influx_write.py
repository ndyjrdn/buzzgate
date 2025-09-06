from influxdb_client import InfluxDBClient, Point, WritePrecision
from datetime import datetime, timezone
# Replace with your actual token
token = "hfqlvolr8DFKXcl3J7-f3KR99o5Cz4ujzEraDzktzkXFK3qiN8QsrBEABYJnuFSM4GBCDZmiLdhMDSqydjThxg"
org = "buzzgate"
bucket = "buzzgate_monitor"

client = InfluxDBClient(
    url="http://localhost:8086",  # or "http://cy:8086" if remote
    token=token,
    org=org
)

write_api = client.write_api()

point = Point("speedtest") \
    .tag("host", "cy") \
    .field("download", 123.45) \
    .field("upload", 67.89) \
    .field("ping", 12.3) \
    .time(datetime.now(timezone.utc), WritePrecision.S)

write_api.write(bucket=bucket, org=org, record=point)
with InfluxDBClient(url="http://localhost:8086", token=token, org=org) as client:
    write_api = client.write_api()
    point = Point("speedtest") \
        .tag("host", "cy") \
        .field("download", 123.45) \
        .field("upload", 67.89) \
        .field("ping", 12.3) \
        .time(datetime.now(timezone.utc), WritePrecision.S)
    write_api.write(bucket=bucket, org=org, record=point)
    print("Write successful")
