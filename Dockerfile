FROM php:8.3-fpm-alpine

RUN apk add --no-cache \
    git \ 
    unzip \
    curl 

RUN docker-php-ext-install pdo pdo_mysql

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html
