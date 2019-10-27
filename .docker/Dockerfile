FROM php:7.3.11-apache

COPY . /var/www/html
COPY .docker/vhosts.conf /etc/apache2/sites-available/000-default.conf

RUN apt-get update && apt-get install -y nano libmcrypt-dev libpng-dev default-mysql-client
RUN docker-php-ext-install mysqli
RUN docker-php-ext-install pdo_mysql
RUN docker-php-ext-install gd
RUN chown -R www-data:www-data /var/www/html/ && a2enmod rewrite
