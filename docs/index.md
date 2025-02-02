---
layout: default
title: Home
nav_order: 1
---

# LitePress Documentation

Welcome to LitePress - a modern WordPress development environment that uses Composer and includes SQLite integration out of the box.

## Quick Start

### Interactive Setup

You can run the following command and answer the interactive questions.

```bash
composer create-project zaherg/litepress litepress
```

### Automated Setup

Or you can have the environment variables presented before the command to be used automatically.

```bash
ADMIN_USER="your-username" \
ADMIN_PASSWORD="your-password" \
ADMIN_EMAIL="admin@example.com" \
WP_HOME="http://your-site-url.test" \
SITE_TITLE="Your Site Title" \
composer create-project zaherg/litepress litepress
```

This is the preferred way for automations.


## Reinstallation

To reset your project:

```bash
ADMIN_PASSWORD="your-password" composer run re-install
```
