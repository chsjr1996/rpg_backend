FROM php:8.2-cli

RUN apt-get update -y
RUN apt-get install libcurl4-openssl-dev libssl-dev -y

RUN pecl install -D 'enable-openssl="yes" enable-http2="yes" enable-swoole-curl="yes" enable-mysqlnd="yes"' swoole
RUN docker-php-ext-enable swoole
RUN docker-php-ext-install pdo_mysql

# Project setup
RUN mkdir /app
COPY . /app
WORKDIR /app
CMD ["php", "web/Server.php"]
EXPOSE 9501 9502