FROM php:8.2-apache

RUN a2enmod rewrite

RUN docker-php-ext-install pdo pdo_mysql

COPY .docker/vhost.conf /etc/apache2/sites-available/000-default.conf

COPY . /var/www/html/

WORKDIR /var/www/html
