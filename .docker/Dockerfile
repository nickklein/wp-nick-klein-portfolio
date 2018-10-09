FROM php:7.2.10-apache

COPY . /var/www/html
COPY .docker/vhosts.conf /etc/apache2/sites-available/000-default.conf

RUN apt-get update && apt-get install -y nano libmcrypt-dev mysql-client && docker-php-ext-install mysqli pdo_mysql gd
RUN chown -R www-data:www-data /var/www/html/ && a2enmod rewrite