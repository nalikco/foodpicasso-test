FROM php:8.3.10-fpm-alpine3.20

ENV COMPOSER_ALLOW_SUPERUSER=1

COPY --from=composer:2.7.7 /usr/bin/composer /usr/local/bin/composer

ADD --chmod=0755 https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN install-php-extensions gd intl zip mysqli pdo_mysql yaml bcmath bz2

RUN apk add nodejs npm

WORKDIR /var/www
