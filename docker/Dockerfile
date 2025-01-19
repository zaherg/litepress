# Use an official PHP-FPM base image
FROM php:8.4-fpm

# Install required packages and PHP extensions
RUN apt-get update && apt-get install -y \
    nginx \
    curl \
    zip \
    unzip \
    git \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    supervisor \
    wget \
    && docker-php-ext-install \
        mbstring \
        exif \
        pcntl \
        bcmath \
        gd \
        zip \
        opcache \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Install confd
RUN wget https://github.com/kelseyhightower/confd/releases/download/v0.16.0/confd-0.16.0-linux-amd64 \
    && mv confd-0.16.0-linux-amd64 /usr/local/bin/confd \
    && chmod +x /usr/local/bin/confd

# Set working directory
WORKDIR /var/www/html

# Create confd structure
RUN mkdir -p /etc/confd/{conf.d,templates}

# Copy confd configuration
COPY ./docker/confd/conf.d /etc/confd/conf.d/
COPY ./docker/confd/templates /etc/confd/templates/

# Copy Supervisor configuration
COPY ./docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Copy entrypoint script
COPY ./docker/docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Set default port
ENV NGINX_PORT=80

# Expose the port dynamically
EXPOSE ${NGINX_PORT}

# Start services
ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]