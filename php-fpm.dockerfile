FROM php:7.4.5-fpm

COPY --from=composer:1.10.5 /usr/bin/composer /usr/bin/composer

WORKDIR /usr/local/app/hello-cors