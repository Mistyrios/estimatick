FROM php:8.4-fpm-alpine

# Install composer
RUN echo "\e[1;33mInstall COMPOSER\e[0m"
RUN cd /tmp \
    && curl -sS https://getcomposer.org/installer | php \
    && mv composer.phar /usr/local/bin/composer

# Update package index
RUN apk update

# Install useful tools
RUN apk add --no-cache nano wget dialog vim

# Install important libraries
RUN echo "\e[1;33mInstall important libraries\e[0m"
RUN apk add --no-cache --virtual .build-deps \
    autoconf \
    g++ \
    make \
    linux-headers \
    && apk add --no-cache \
    git \
    curl \
    curl-dev \
    libmcrypt-dev \
    icu-dev \
    oniguruma-dev \
    libxml2-dev \
    postgresql-dev \
    nodejs \
    npm \
    && docker-php-ext-configure intl \
    && docker-php-ext-install intl

# Install GD dependencies and GD extension
RUN apk add --no-cache \
    libjpeg-turbo-dev \
    libpng-dev \
    freetype-dev \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd

# Install PostgreSQL PDO
RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql \
    && docker-php-ext-install pdo pdo_pgsql pgsql

# Enable OPcache
RUN docker-php-ext-install opcache

# Configure OPcache for DEVELOPMENT
RUN echo "opcache.enable=1" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.enable_cli=1" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.memory_consumption=128" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.interned_strings_buffer=8" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.max_accelerated_files=10000" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.revalidate_freq=0" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.validate_timestamps=1" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.save_comments=1" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.fast_shutdown=1" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.max_wasted_percentage=15" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.consistency_checks=1" >> /usr/local/etc/php/conf.d/opcache.ini \
    && echo "opcache.force_restart_timeout=180" >> /usr/local/etc/php/conf.d/opcache.ini

# Install and configure APCu for DEVELOPMENT
RUN pecl install apcu \
    && docker-php-ext-enable apcu \
    && echo "apc.enabled=1" >> /usr/local/etc/php/conf.d/apcu.ini \
    && echo "apc.enable_cli=1" >> /usr/local/etc/php/conf.d/apcu.ini \
    && echo "apc.shm_size=64M" >> /usr/local/etc/php/conf.d/apcu.ini \
    && echo "apc.entries_hint=4096" >> /usr/local/etc/php/conf.d/apcu.ini \
    && echo "apc.ttl=7200" >> /usr/local/etc/php/conf.d/apcu.ini \
    && echo "apc.gc_ttl=3600" >> /usr/local/etc/php/conf.d/apcu.ini \
    && echo "apc.slam_defense=1" >> /usr/local/etc/php/conf.d/apcu.ini

# Enable xDebug
RUN pecl install xdebug \
    && docker-php-ext-enable xdebug \
    && echo "xdebug.mode=debug" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_host=host.docker.internal" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.idekey=PHPSTORM" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.start_with_request=yes" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.client_port=9003" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.log=/dev/null" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini \
    && echo "xdebug.log_level=0" >> /usr/local/etc/php/conf.d/docker-php-ext-xdebug.ini

# Clean up build dependencies
RUN apk del .build-deps

