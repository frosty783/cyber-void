#!/bin/bash
set -e

echo "[*] Starting Node WebSocket backend..."
node /app/server.js &

echo "[*] Starting Apache..."
apache2-foreground
