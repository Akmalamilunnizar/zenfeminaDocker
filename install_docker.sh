#!/bin/bash

# Update system
echo "📦 Updating system..."
apt update && apt upgrade -y

# Install Docker
echo "🐳 Installing Docker..."
apt install -y docker.io

# Enable Docker service
systemctl start docker
systemctl enable docker

# Verify Docker
docker --version

# Install Docker Compose (manual latest)
echo "⚙️ Installing Docker Compose..."
curl -L "https://github.com/docker/compose/releases/download/v2.18.1/docker-compose-$(uname -s)-$(uname -m)" -o /usr/local/bin/docker-compose
chmod +x /usr/local/bin/docker-compose

# Verify Docker Compose
docker-compose --version

echo "✅ Docker & Docker Compose installation completed!"
