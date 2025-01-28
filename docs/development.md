---
layout: default
title: Development
nav_order: 3
---

# Development Guide

## Project Structure

LitePress follows modern WordPress development practices:

- `wp-content/` - Themes and plugins
- `mu-plugins/` - Must-use plugins
- `wp/` - WordPress core (managed by Composer)

## Local Development

1. Clone the repository
2. Run `composer install`
3. Configure your `.env` file
4. Start development!

## Reinstallation

To reset your project:

```bash
ADMIN_PASSWORD="your-password" composer run re-install
```

## Important Notes

- Some WordPress plugins may not support SQLite due to MySQL-specific syntax
- Environment variable changes require container restart when using Docker
- Use WordPress coding standards for development