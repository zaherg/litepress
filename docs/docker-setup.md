---
layout: default
title: Docker Setup
nav_order: 2
---

# Docker Setup

LitePress includes Docker support for easy development. Here's how to get started:

## Prerequisites

- Docker
- Docker Compose
- LitePress installed via Composer

## Configuration

1. Configure environment variables in `.env`:
```env
NGINX_PORT=80      # Change if port 80 is in use
REDIS_PORT=6379    # Change if port 6379 is in use
```

## Starting Docker

Run the following command:

```bash
docker-compose up -d
```

Your application will be available at `http://127.0.0.1` (or your configured port).

## Docker Stack

The Docker setup includes:
- PHP-FPM with Nginx
- Redis for caching
- Automatic environment configuration