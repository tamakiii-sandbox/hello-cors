FROM php:7.4.5-fpm

COPY --from=composer:1.10.5 /usr/bin/composer /usr/bin/composer

RUN apt-get update && \
    apt-get install -y --no-install-recommends \
      git \
      && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/

WORKDIR /usr/local/app/hello-cors