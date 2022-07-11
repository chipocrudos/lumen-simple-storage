FROM php:7.4-apache

RUN docker-php-ext-install pdo_mysql

WORKDIR /var/www/html/
COPY ./docker/api-storage/upload.ini /usr/local/etc/php/conf.d/upload.ini
RUN a2enmod rewrite headers

RUN apt update && apt install -y \
    zlib1g-dev \
    libzip-dev \
    zip \
    unzip  && apt autoclean
RUN docker-php-ext-install pdo_mysql zip
RUN php -r "readfile('http://getcomposer.org/installer');" | php -- --install-dir=/usr/bin/ --filename=composer

COPY ./api-storage/. .
RUN composer install

VOLUME "/var/www/html/public/upload"