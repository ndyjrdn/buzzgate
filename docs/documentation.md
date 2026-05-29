# Home Assistant System Documentation

> **Last Updated:** 2026-05-29  
> **Maintainer:** Andy  
> **Stack:** Home Assistant · Docker · Zigbee2MQTT · Mosquitto · Portainer · Tailscale

---

## Table of Contents

1. [System Overview](#1-system-overview)
2. [Directory Structure](#2-directory-structure)
3. [Docker Compose Files](#3-docker-compose-files)
4. [Groups & Automations Layout](#4-groups--automations-layout)
5. [Networking](#5-networking)
6. [Remote Access via Tailscale](#6-remote-access-via-tailscale)
7. [Recovery Steps](#7-recovery-steps)
8. [Maintenance Runbook](#8-maintenance-runbook)
9. [Troubleshooting Reference](#9-troubleshooting-reference)

---

## 1. System Overview

### Architecture Diagram

+-------------------------------------+
|           Docker Host (Linux)        |
|                                      |
|  +--------------+  +-------------+  |
|  | Home Assistant|  |  Portainer  |  |
|  |  (port 8123) |  | (port 9000) |  |
|  +------+-------+  +-------------+  |
|         | MQTT                        |
|  +------v-------+                    |
|  |  Mosquitto   |                    |
|  | MQTT Broker  |                    |
|  |  (port 1883) |                    |
|  +------+-------+                    |
|         | MQTT                        |
|  +------v-------+                    |
|  | Zigbee2MQTT  |                    |
|  | (port 8080)  |                    |
|  +------+-------+                    |
|         | Serial/USB                  |
|  +------v-------+                    |
|  | Zigbee Coord.|                    |
|  | (USB dongle) |                    |
|  +-------------+                    |
+------+------------------------------+
| Tailscale VPN
+--------v--------+
|  Remote Access  |
| (phone/laptop)  |
+-----------------+


### Component Roles

| Component        | Role                                                                 | Port(s)       |
|------------------|----------------------------------------------------------------------|---------------|
| Home Assistant   | Core automation engine, UI, integrations                             | 8123          |
| Mosquitto        | MQTT message broker; bridges HA <-> Zigbee2MQTT                     | 1883, 9001    |
| Zigbee2MQTT      | Translates Zigbee device messages to/from MQTT topics               | 8080          |
| Portainer        | Docker container management UI                                       | 9000, 9443    |
| Tailscale        | Zero-config VPN for secure remote access                             | —             |

---

## 2. Directory Structure

/opt/homeassistant/                    # Root project directory
├── docker-compose.yml                 # Primary compose file (HA + Mosquitto + Z2M)
├── docker-compose.portainer.yml       # Portainer compose (managed separately)
├── .env                               # Environment variables (not committed to git)
│
├── homeassistant/                     # HA configuration volume
│   ├── configuration.yaml             # Main HA config entry point
│   ├── secrets.yaml                   # Secrets (gitignored)
│   ├── automations.yaml               # Top-level automations file
│   ├── scripts.yaml                   # HA scripts
│   ├── scenes.yaml                    # HA scenes
│   │
│   ├── groups/                        # Modularized group definitions
│   │   ├── light_groups.yaml          # All light group entities
│   │   └── curtain_groups.yaml        # All curtain/cover group entities
│   │
│   ├── automations/                   # Modularized automation files
│   │   ├── lighting/                  # Lighting automations
│   │   ├── curtains/                  # Curtain automations
│   │   └── system/                    # System-level automations (startup, watchdog)
│   │
│   ├── custom_components/             # HACS / manual custom integrations
│   └── www/                           # Lovelace frontend static assets
│
├── zigbee2mqtt/                       # Z2M configuration volume
│   ├── configuration.yaml             # Z2M config (coordinator, MQTT, devices)
│   └── devices/                       # Auto-generated device DB (do not edit manually)
│
├── mosquitto/                         # Mosquitto configuration volume
│   ├── config/
│   │   └── mosquitto.conf             # Broker config
│   ├── data/                          # Persistence files
│   └── log/                           # Broker logs
│
└── backups/                           # HA snapshot/backup directory
    └── YYYY-MM-DD/                    # Date-stamped backup folders

> **Git hygiene:** `.env`, `secrets.yaml`, `mosquitto/data/`, and `backups/` should be listed in `.gitignore`.

---

## 3. Docker Compose Files

### 3.1 Primary Compose (docker-compose.yml)

version: "3.8"

services:

  homeassistant:
    container_name: homeassistant
    image: ghcr.io/home-assistant/home-assistant:stable
    restart: unless-stopped
    privileged: true
    network_mode: host
    volumes:
      - ./homeassistant:/config
      - /etc/localtime:/etc/localtime:ro
    environment:
      - TZ=${TZ}
    depends_on:
      - mosquitto

  mosquitto:
    container_name: mosquitto
    image: eclipse-mosquitto:latest
    restart: unless-stopped
    ports:
      - "1883:1883"
      - "9001:9001"
    volumes:
      - ./mosquitto/config:/mosquitto/config
      - ./mosquitto/data:/mosquitto/data
      - ./mosquitto/log:/mosquitto/log

  zigbee2mqtt:
    container_name: zigbee2mqtt
    image: koenkk/zigbee2mqtt:latest
    restart: unless-stopped
    ports:
      - "8080:8080"
    volumes:
      - ./zigbee2mqtt:/app/data
      - /run/udev:/run/udev:ro
    devices:
      - ${ZIGBEE_DEVICE}:/dev/ttyUSB0
    environment:
      - TZ=${TZ}
    depends_on:
      - mosquitto

### 3.2 Portainer Compose (docker-compose.portainer.yml)

version: "3.8"

services:
  portainer:
    container_name: portainer
    image: portainer/portainer-ce:latest
    restart: unless-stopped
    ports:
      - "9000:9000"
      - "9443:9443"
    volumes:
      - /var/run/docker.sock:/var/run/docker.sock
      - portainer_data:/data

volumes:
  portainer_data:

### 3.3 Environment Variables (.env)

TZ=America/Chicago
ZIGBEE_DEVICE=/dev/ttyUSB0
HA_CONFIG_DIR=./homeassistant

---

## 4. Groups & Automations Layout

### 4.1 Referencing Modular Files in configuration.yaml

homeassistant:
  packages: !include_dir_named packages/

group: !include_dir_merge_named groups/

automation: !include_dir_merge_list automations/
script:     !include scripts.yaml
scene:      !include scenes.yaml

### 4.2 Light Groups (groups/light_groups.yaml)

living_room_lights:
  name: "Living Room Lights"
  entities:
    - light.living_room_main
    - light.living_room_lamp_1
    - light.living_room_lamp_2

bedroom_lights:
  name: "Bedroom Lights"
  entities:
    - light.bedroom_ceiling
    - light.bedside_left
    - light.bedside_right

### 4.3 Curtain Groups (groups/curtain_groups.yaml)

living_room_curtains:
  name: "Living Room Curtains"
  entities:
    - cover.living_room_curtain_left
    - cover.living_room_curtain_right

bedroom_curtains:
  name: "Bedroom Curtains"
  entities:
    - cover.bedroom_curtain_main

### 4.4 Automations Directory Convention

- alias: "Turn on living room at sunset"
  trigger:
    - platform: sun
      event: sunset
      offset: "-00:15:00"
  action:
    - service: light.turn_on
      target:
        entity_id: group.living_room_lights
      data:
        brightness_pct: 80
        color_temp: 400

---

## 5. Networking

### 5.1 Network Topology

LAN (192.168.x.x)
  └── Docker Host
        ├── homeassistant  → host network (inherits host IP)
        ├── mosquitto      → bridge, exposes :1883, :9001
        ├── zigbee2mqtt    → bridge, exposes :8080
        └── portainer      → bridge, exposes :9000, :9443

> Home Assistant runs in `network_mode: host` so it can discover mDNS devices without extra configuration.

### 5.2 Port Reference

| Service        | Protocol | Port  | Purpose                        | Exposed Externally? |
|----------------|----------|-------|--------------------------------|---------------------|
| Home Assistant | HTTP     | 8123  | Web UI & API                   | Via Tailscale only  |
| Mosquitto      | MQTT     | 1883  | Device/service MQTT            | LAN only            |
| Mosquitto      | WS       | 9001  | WebSocket MQTT                 | LAN only            |
| Zigbee2MQTT    | HTTP     | 8080  | Z2M Web UI                     | LAN only            |
| Portainer      | HTTP     | 9000  | Container management           | LAN only            |
| Portainer      | HTTPS    | 9443  | Container management (TLS)     | LAN only            |

### 5.3 Mosquitto Configuration (mosquitto/config/mosquitto.conf)

listener 1883
allow_anonymous false
password_file /mosquitto/config/passwd

listener 9001
protocol websockets

persistence true
persistence_location /mosquitto/data/

log_dest file /mosquitto/log/mosquitto.log
log_type error
log_type warning
log_type information
log_type debug

### 5.4 Zigbee2MQTT MQTT Config (zigbee2mqtt/configuration.yaml excerpt)

mqtt:
  base_topic: zigbee2mqtt
  server: mqtt://mosquitto:1883
  user: z2m_user
  password: !secret mqtt_password

serial:
  port: /dev/ttyUSB0

frontend:
  port: 8080

homeassistant: true

---

## 6. Remote Access via Tailscale

### 6.1 Setup Overview

Tailscale is installed on the Docker host (not inside a container). It creates a WireGuard-based
mesh VPN that allows secure access to all LAN services from anywhere without port forwarding.

### 6.2 Installation (Debian/Ubuntu host)

curl -fsSL https://tailscale.com/install.sh | sh
sudo tailscale up --authkey=<your-auth-key>

### 6.3 Accessing Services Remotely

| Service        | URL                        |
|----------------|----------------------------|
| Home Assistant | http://100.x.x.x:8123      |
| Zigbee2MQTT    | http://100.x.x.x:8080      |
| Portainer      | https://100.x.x.x:9443     |

> Tip: Assign a stable machine name in the Tailscale admin console (e.g. ha-server)
> so you can use http://ha-server:8123 instead of the IP.

### 6.4 Tailscale Subnet Router (Optional)

sudo tailscale up --advertise-routes=192.168.1.0/24 --accept-routes

Approve the subnet route in the Tailscale admin console.

### 6.5 Home Assistant Trusted Networks

homeassistant:
  auth_providers:
    - type: homeassistant
    - type: trusted_networks
      trusted_networks:
        - 192.168.1.0/24    # LAN
        - 100.64.0.0/10     # Tailscale CGNAT range
      allow_bypass_login: true

---

## 7. Recovery Steps

### 7.1 Full System Recovery (New Host)

#### Step 1 — Install Prerequisites

curl -fsSL https://get.docker.com | sh
sudo usermod -aG docker $USER
newgrp docker
sudo apt install -y docker-compose-plugin
curl -fsSL https://tailscale.com/install.sh | sh

#### Step 2 — Restore Project Files

git clone https://github.com/<you>/homeassistant-config.git /opt/homeassistant
cd /opt/homeassistant
cp /path/to/backup/secrets.yaml homeassistant/secrets.yaml
cp /path/to/backup/.env .env

#### Step 3 — Restore Mosquitto Passwords

docker run --rm -v $(pwd)/mosquitto/config:/mosquitto/config \
  eclipse-mosquitto mosquitto_passwd -c /mosquitto/config/passwd <username>

#### Step 4 — Reconnect Zigbee Coordinator

ls /dev/serial/by-id/
nano .env   # set ZIGBEE_DEVICE=/dev/serial/by-id/usb-...

#### Step 5 — Start the Stack

docker compose up -d
docker compose -f docker-compose.portainer.yml up -d

#### Step 6 — Reconnect Tailscale

sudo tailscale up --authkey=<your-auth-key>

#### Step 7 — Verify Services

docker ps
curl http://localhost:8123
curl http://localhost:8080
docker logs zigbee2mqtt --tail 50

---

### 7.2 Partial Recovery Scenarios

#### Scenario: HA Container Crashed

docker compose restart homeassistant
docker logs homeassistant --tail 100

#### Scenario: Zigbee Devices Unresponsive

ls /dev/ttyUSB*
docker logs zigbee2mqtt --tail 50
docker compose restart zigbee2mqtt

#### Scenario: MQTT Broker Down

docker compose restart mosquitto
docker logs mosquitto --tail 50
docker exec -it mosquitto mosquitto_sub -h localhost -t '#' -u <user> -P <pass>

#### Scenario: Restore From HA Snapshot

1. Copy the .tar snapshot file into homeassistant/backups/
2. Navigate to Settings → System → Backups in the HA UI
3. Select the snapshot → Restore
4. Restart HA after restore completes

---

## 8. Maintenance Runbook

### 8.1 Routine Tasks

| Task                             | Frequency    | Command / Location                              |
|----------------------------------|--------------|-------------------------------------------------|
| Pull latest container images     | Monthly      | docker compose pull && docker compose up -d     |
| Create HA snapshot               | Weekly       | Settings → System → Backups → Create backup     |
| Review Mosquitto logs            | Weekly       | tail -f mosquitto/log/mosquitto.log             |
| Check Tailscale key expiry       | Monthly      | Tailscale admin console                         |
| Prune unused Docker images       | Monthly      | docker image prune -a                           |
| Check Z2M for OTA firmware       | Monthly      | Z2M UI → Device → Check OTA                     |

### 8.2 Updating Home Assistant

docker compose pull homeassistant
docker compose up -d homeassistant
docker logs homeassistant -f

> Always create a manual snapshot before updating HA.

### 8.3 Updating Zigbee2MQTT

docker compose pull zigbee2mqtt
docker compose up -d zigbee2mqtt

### 8.4 Adding a New Zigbee Device

1. Open Z2M web UI → Permit join (60 seconds)
2. Power on / reset the new device
3. Device appears in Z2M device list with auto-generated friendly_name
4. Rename in Z2M UI; entity auto-appears in HA via MQTT Discovery
5. Add to the appropriate group in groups/light_groups.yaml or groups/curtain_groups.yaml
6. Reload groups in HA: Developer Tools → YAML → Groups

### 8.5 Adding a New Group

1. Edit the appropriate YAML file:
   - Lights  → homeassistant/groups/light_groups.yaml
   - Curtains → homeassistant/groups/curtain_groups.yaml
2. Add the group definition following the existing pattern
3. Reload: Developer Tools → YAML → Groups (no restart needed)

### 8.6 Adding a New Automation

1. Create or edit a file under homeassistant/automations/<domain>/
2. Reload: Developer Tools → YAML → Automations (no restart needed)
3. Commit: git add . && git commit -m "feat: add <automation name>"

---

## 9. Troubleshooting Reference

### Container Won't Start

docker compose config
docker compose up --no-start
docker logs <container_name>

### HA Can't Connect to MQTT

1. Verify Mosquitto is running: docker ps | grep mosquitto
2. Check credentials in secrets.yaml match the Mosquitto password file
3. Test broker: docker exec mosquitto mosquitto_pub -h localhost -t test -m hello -u <user> -P <pass>
4. Check HA logs: Settings → System → Logs → filter "mqtt"

### Zigbee2MQTT Reports Serial Error

ls /dev/serial/by-id/
docker inspect zigbee2mqtt | grep -i device
docker compose up -d zigbee2mqtt

### Tailscale Loses Connectivity

sudo tailscale status
sudo tailscale up
sudo systemctl restart tailscaled

### HA UI Unreachable Locally

curl -I http://localhost:8123
docker logs homeassistant | grep -i error
docker exec homeassistant hass --script check_config

---

## Appendix A — Useful Commands Cheat Sheet

# Start all services
docker compose up -d && docker compose -f docker-compose.portainer.yml up -d

# Stop all services
docker compose down && docker compose -f docker-compose.portainer.yml down

# Restart a single service
docker compose restart <service>      # homeassistant | mosquitto | zigbee2mqtt

# View live logs
docker logs -f <container_name>

# Validate HA config
docker exec homeassistant hass --script check_config

# Subscribe to all MQTT topics (debug)
docker exec mosquitto mosquitto_sub -h localhost -t '#' -u <user> -P <pass>

# Tailscale status
sudo tailscale status

# Prune stopped containers + unused images
docker system prune -a

---

## Appendix B — Secrets Reference

> secrets.yaml is gitignored. Keep a secure offline copy (e.g. Bitwarden).

| Key                  | Used In                          | Description                      |
|----------------------|----------------------------------|----------------------------------|
| mqtt_password        | zigbee2mqtt/configuration.yaml   | Z2M MQTT broker password         |
| mqtt_username        | zigbee2mqtt/configuration.yaml   | Z2M MQTT broker username         |
| tailscale_authkey    | Host CLI                         | Tailscale reusable auth key      |
| ha_secret_key        | configuration.yaml               | HA internal secret (if used)     |

---

*Generated: 2026-05-29 · Stack: Home Assistant + Docker + Zigbee2MQTT + Mosquitto + Portainer + Tailscale*

