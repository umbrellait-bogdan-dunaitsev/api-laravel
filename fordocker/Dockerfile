FROM php:7.4-apache

RUN docker-php-ext-install pdo_mysql \
    && a2enmod \
    rewrite

COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

RUN apt-get update && apt-get install -y \
  zip  \
  unzip \
  git \
  && composer require laravel/ui

