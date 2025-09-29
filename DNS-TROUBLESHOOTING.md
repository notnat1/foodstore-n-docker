# Docker DNS Resolution Troubleshooting

## Overview

This document provides guidance on resolving DNS-related issues that may occur during Docker builds or when running Docker containers in the Food Store application.

## Common DNS Issues

The most common DNS-related error you might encounter is:

```
Temporary failure resolving 'deb.debian.org'
```

This error occurs when Docker containers cannot resolve domain names, which prevents them from downloading packages during the build process.

## Solutions Implemented

The following solutions have been implemented in this project to address DNS resolution issues:

### 1. DNS Configuration in Docker Compose

All services in both `docker-compose.yml` and `docker-compose.nginx.yml` have been configured with Google's public DNS servers:

```yaml
dns:
  - 8.8.8.8
  - 8.8.4.4
```

This ensures that containers can resolve domain names even if the host's DNS resolution is problematic.

### 2. DNS Configuration in Dockerfiles

For the build process, the `apache.Dockerfile` and `php.Dockerfile` have been updated to include DNS configuration:

```dockerfile
RUN echo "nameserver 8.8.8.8\nnameserver 8.8.4.4" > /etc/resolv.conf && \
    apt-get update --allow-releaseinfo-change && apt-get install -y ...
```

This helps resolve DNS issues during the image build process.

## Additional Troubleshooting Steps

If you still encounter DNS resolution issues, try the following:

### Check Docker Network

```bash
docker network ls
docker network inspect food-store-network
```

### Verify Host DNS Configuration

```bash
cat /etc/resolv.conf  # Linux/Mac
ipconfig /all         # Windows
```

### Restart Docker Service

```bash
# Windows
Restart-Service docker

# Linux
sudo systemctl restart docker

# Mac
osascript -e 'quit app "Docker"'
open -a Docker
```

### Use Host Network Mode (Not Recommended for Production)

As a last resort, you can try using the host network mode:

```yaml
network_mode: "host"
```

Note: This is not recommended for production environments as it bypasses Docker's network isolation.

## References

- [Docker DNS Configuration Documentation](https://docs.docker.com/config/containers/container-networking/)
- [Docker Compose DNS Configuration](https://docs.docker.com/compose/compose-file/compose-file-v3/#dns)