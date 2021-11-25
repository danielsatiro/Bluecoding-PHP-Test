FROM alpine:3.14
#FROM php:7.4-fpm-alpine

#RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini"

RUN apk add --update \
    php7-fpm \
    php7-apcu \
    php7-ctype \
    php7-curl \
    php7-dom \
    php7-gd \
    php7-fileinfo \
    php7-iconv \
    php7-imagick \
    php7-json \
    php7-intl \
    php7-mbstring \
    php7-opcache \
    php7-openssl \
    php7-pdo \
    php7-pdo_mysql \
    php7-pdo_sqlite \
    php7-mysqli \
    php7-xml \
    php7-zlib \
    php7-phar \
    php7-tokenizer \
    php7-session \
    php7-simplexml \
    php7-sqlite3 \
    php7-xdebug \
    php7-xmlreader \
    php7-xmlwriter \
    php7-zip \
    php7-redis \
    php7-memcached \
    php7-pcntl \
    php7-posix \
    make \
    curl \
    git \
    memcached \
    nodejs \
    npm

RUN touch /etc/php7/conf.d/uploads.ini \
    && echo "upload_max_filesize = 10M;" >> /etc/php7/conf.d/uploads.ini \
    && echo "max_input_vars = 5000;" >> /etc/php7/conf.d/uploads.ini

RUN apk add --no-cache bash

RUN rm -rf /var/cache/apk/* && rm -rf /tmp/* && \
    curl --insecure https://getcomposer.org/composer.phar -o /usr/bin/composer && chmod +x /usr/bin/composer

#ADD xdebug.ini  /etc/php7/conf.d/

ADD api.pool.conf /etc/php7/php-fpm.d/

CMD ["php-fpm7", "-F"]

WORKDIR /var/www/api
EXPOSE 9000
