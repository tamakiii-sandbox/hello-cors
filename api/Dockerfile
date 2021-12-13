FROM php:7.4.5-fpm

WORKDIR /usr/local/app/hello-cors/api

COPY --from=composer:1.10.5 /usr/bin/composer /usr/bin/composer

RUN apt-get update && \
    apt-get install -y --no-install-recommends \
      make \
      git \
      && \
    apt-get clean && \
    rm -rf /var/lib/apt/lists/

COPY ./etc/users.test.json /var/tmp/users.json

RUN chown root:www-data /var/tmp/users.json && \
    chmod g+w /var/tmp/users.json