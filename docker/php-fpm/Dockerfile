FROM php:7.4-fpm-alpine

RUN apk update && apk add composer bash graphviz

RUN apk add --no-cache $PHPIZE_DEPS icu-dev php-intl \
    && pecl install xdebug apcu \
    && docker-php-ext-install opcache intl mysqli pdo pdo_mysql \
    && docker-php-ext-configure intl \
    && docker-php-ext-enable xdebug apcu intl

RUN curl -sS https://get.symfony.com/cli/installer | bash

RUN mv /root/.symfony/bin/symfony /usr/local/bin/symfony

COPY ./xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini
COPY ./php.ini /usr/local/etc/php/conf.d/php.ini

WORKDIR /data/application