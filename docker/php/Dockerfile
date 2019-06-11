FROM php:7.3.6-fpm-alpine

RUN apk update && apk upgrade
RUN apk add bash git unzip wget zlib-dev libzip-dev gnupg g++ autoconf make icu-dev

RUN pecl install apcu-5.1.16 && echo extension=apcu.so > /usr/local/etc/php/conf.d/apcu.ini

RUN apk add libpq=11.3-r2 postgresql-dev=11.3-r2 postgresql-client=11.3-r2 --update-cache --repository http://dl-3.alpinelinux.org/alpine/edge/main/
RUN docker-php-ext-install intl zip pdo pdo_pgsql opcache pgsql sockets bcmath

ADD docker/php/php.ini /usr/local/etc/php/php.ini

RUN addgroup -g 1000 -S app && \
    adduser -u 1000 -S app -G app

WORKDIR /var/www/symfony
RUN apk add composer
