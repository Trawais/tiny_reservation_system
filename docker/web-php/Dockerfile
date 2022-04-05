FROM php:7.3-apache

# Install git and zip
RUN apt update && apt install -y git zip

# xDebug
RUN pecl install xdebug && docker-php-ext-enable xdebug
RUN echo 'xdebug.remote_port=9000' >> /usr/local/etc/php/php.ini
RUN echo 'xdebug.remote_enable=1' >> /usr/local/etc/php/php.ini
RUN echo 'xdebug.remote_autostart=1' >> /usr/local/etc/php/php.ini
RUN echo 'xdebug.remote_host=docker.for.mac.localhost' >> /usr/local/etc/php/php.ini
RUN echo 'xdebug.remote_handler=dbgp' >> /usr/local/etc/php/php.ini

# Needed Extensions
RUN docker-php-ext-install pdo pdo_mysql

# Download composer package manager
COPY --from=composer:1 /usr/bin/composer /usr/local/bin/composer
