# LitePress

This is a personal project that will set up WordPress using composer and will install sqlite integration plugin automatically.

The `mu-plugins` folder contains some plugins I copied from a WordPress project created by **WordPress Studio**.

## Creating a Project

There are two ways to create a new LitePress project:

### 1. Simple Setup

Run the command:

```bash
composer create-project zaherg/litepress litepress
```

> [!TIP]
> To get the development code you can run
> ```bash
> composer create-project zaherg/litepress litepress -s dev
> ```


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
composer create-project zaherg/litepress litepress --no-interaction
```

After installation is complete, you can login to your WordPress dashboard using either:
- The default credentials if you used the simple setup
- The username and password you specified in `ADMIN_USER` and `ADMIN_PASSWORD` if you used the automated setup

## Running with Docker

The project includes Docker support to facilitate easy development. To run the project using Docker:

1. Make sure you have Docker and Docker Compose installed on your system and the project is installed using one of the above installation steps.

2. (Optional) Configure the environment variables in `.env`:
   ```env
   NGINX_PORT=80       # Change if port 80 is already in use
   REDIS_PORT=6379     # Change if port 6379 is already in use
   ```

3. Start the Docker containers:
   ```bash
   docker-compose up -d
   ```

4. Your application will be available at `http://127.0.0.1` (or the port you specified in NGINX_PORT).

The Docker setup includes:
- PHP-FPM with Nginx
- Redis for caching
- Automatic environment configuration

## Reinstallation

To reset your project and start with a fresh WordPress installation, run:

```bash
ADMIN_PASSWORD="your-password" composer run re-install
```

Note: You must provide the `ADMIN_PASSWORD` environment variable when running the reinstall command. This password will be used for the admin account in the fresh installation.

## Important Notes

- Not all WordPress plugins support SQLite. Some plugins use MySQL-specific syntax when creating additional tables.
- When using automated setup, if any required environment variables are missing, the installer will prompt you to provide them before proceeding.
- When running with Docker, any changes to environment variables require a container restart: `docker-compose restart`