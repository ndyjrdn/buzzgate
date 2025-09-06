#!/bin/bash
cd /home/andy/buzzgate/monitor/speedtest
source venv/bin/activate
./speedtest.sh
python parse_speedtest_influx.py
