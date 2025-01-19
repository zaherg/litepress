# LitePress

This is a personal project which will setup WordPress using composer and will install sqlite integration plugin automatically.

The `mu-plugins` folder contains some plugins I copied from a WordPress project created by **Wordpress Studio**.

## Creating a Project

There are two ways to create a new LitePress project:

### 1. Simple Setup

Run the command:

```bash
composer create-project zaherg/litepress litepress
```

This will create a new project with default settings:
- Username: admin
- Password: password

### 2. Automated Setup

Run the command with environment variables:

```bash
ADMIN_USER="your-username" \
ADMIN_PASSWORD="your-password" \
ADMIN_EMAIL="admin@example.com" \
WP_HOME="http://your-site-url.test" \
SITE_TITLE="Your Site Title" \
composer create-project zaherg/litepress litepress
```

After installation is complete, you can login to your WordPress dashboard using either:
- The default credentials if you used the simple setup
- The username and password you specified in `ADMIN_USER` and `ADMIN_PASSWORD` if you used the automated setup

## Reinstallation

To reset your project and start with a fresh WordPress installation, run:

```bash
ADMIN_PASSWORD="your-password" composer run re-install
```

Note: You must provide the `ADMIN_PASSWORD` environment variable when running the reinstall command. This password will be used for the admin account in the fresh installation.

## Important Notes

- Not all WordPress plugins support SQLite. Some plugins use MySQL-specific syntax when creating additional tables.
- When using automated setup, if any required environment variables are missing, the installer will prompt you to provide them before proceeding.
