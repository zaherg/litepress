---
layout: default
title: Home
nav_order: 1
---

# LitePress Documentation

Welcome to LitePress - a modern WordPress development environment that uses Composer and includes SQLite integration out of the box.

## Quick Start

### Simple Setup

```bash
composer create-project zaherg/litepress litepress
```

### Advanced Setup

```bash
ADMIN_USER="your-username" \
ADMIN_PASSWORD="your-password" \
ADMIN_EMAIL="admin@example.com" \
WP_HOME="http://your-site-url.test" \
SITE_TITLE="Your Site Title" \
composer create-project zaherg/litepress litepress
```

## Default Credentials
When using simple setup:
- Username: `admin`
- Password: `password`