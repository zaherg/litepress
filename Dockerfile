# Build confd stage
FROM golang:1.22.11-alpine AS confd-builder

ARG CONFD_VERSION=0.18.2

ADD https://github.com/abtreece/confd/archive/v${CONFD_VERSION}.tar.gz /tmp/

RUN apk add --no-cache \
    bzip2 \
    make && \
  mkdir -p /go/src/github.com/abtreece/confd && \
  cd /go/src/github.com/abtreece/confd && \
  tar --strip-components=1 -zxf /tmp/v${CONFD_VERSION}.tar.gz && \
  go install github.com/abtreece/confd && \
  rm -rf /tmp/v${CONFD_VERSION}.tar.gz

# Main application stage
FROM php:8.3-fpm

# Set default port
ARG NGINX_PORT=80
ENV NGINX_PORT=${NGINX_PORT}

# Copy confd binary from builder stage
COPY --from=confd-builder /go/bin/confd /usr/local/bin/confd
RUN chmod u+x /usr/local/bin/confd

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

# Set working directory
WORKDIR /var/www

# Copy confd configuration
COPY ./docker/confd/conf.d /etc/confd/conf.d/
COPY ./docker/confd/templates /etc/confd/templates/

# Copy Supervisor configuration
COPY ./docker/supervisord.conf /etc/supervisor/conf.d/supervisord.conf

# Copy custom php settings
COPY ./docker/php/custom.ini /usr/local/etc/php/conf.d/custom.ini

# Copy entrypoint script
COPY ./docker/docker-entrypoint.sh /usr/local/bin/
RUN chmod +x /usr/local/bin/docker-entrypoint.sh

# Expose the port dynamically
EXPOSE ${NGINX_PORT}

# Start services
ENTRYPOINT ["docker-entrypoint.sh"]
CMD ["supervisord", "-c", "/etc/supervisor/conf.d/supervisord.conf"]