
FROM php:8.0-fpm-alpine

RUN apk update \
    && apk add --update-cache --no-cache \
        git \
        zip \
        unzip

COPY --from=composer:2.1 /usr/bin/composer /usr/bin/composer
