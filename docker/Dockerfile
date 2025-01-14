FROM php:8.1-fpm-alpine3.21

ARG APP_ENV
RUN apk add --no-cache git

COPY --from=mlocati/php-extension-installer /usr/bin/install-php-extensions /usr/local/bin/

RUN install-php-extensions zip bcmath @composer; \
    rm /usr/local/bin/install-php-extensions;

RUN apk add --no-cache postgresql-dev && \
    docker-php-ext-install pdo pdo_pgsql

RUN apk add --no-cache bash; \
    curl -1sLf 'https://dl.cloudsmith.io/public/symfony/stable/setup.alpine.sh' | bash; \
    apk add symfony-cli

COPY . /app

WORKDIR /app
