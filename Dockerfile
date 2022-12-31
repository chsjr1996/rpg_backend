FROM php:8.2-cli

RUN apt-get update -y
RUN apt-get install libcurl4-openssl-dev libssl-dev -y

RUN pecl install -D 'enable-openssl="yes" enable-http2="yes" enable-swoole-curl="yes" enable-mysqlnd="yes"' swoole
RUN docker-php-ext-enable swoole
RUN docker-php-ext-install pdo_mysql