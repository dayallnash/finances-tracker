FROM php:7.4-apache

ADD . /var/www/html

RUN apt-get update
RUN apt-get install -y libpq-dev libgmp-dev libbz2-dev zlib1g-dev libssh2-1-dev git
RUN ln -s /usr/include/x86_64-linux-gnu/gmp.h /usr/include/gmp.h
RUN docker-php-ext-install pdo_mysql gmp bz2
RUN apt-get update
RUN apt-get install -y libfreetype6-dev libjpeg62-turbo-dev libpng-dev libgd-dev
RUN docker-php-ext-configure gd
RUN docker-php-ext-install gd exif
RUN a2enmod rewrite
RUN a2enmod ssl
RUN cp /var/www/html/default-ssl.conf /etc/apache2/sites-enabled/default-ssl.conf
RUN cp /var/www/html/certificate.crt /etc/ssl/certs/certificate.crt
RUN cp /var/www/html/private.key /etc/ssl/certs/private.key
RUN mv /usr/local/etc/php/php.ini-development /usr/local/etc/php/php.ini
RUN curl -sS https://getcomposer.org/installer | php
RUN mv composer.phar /usr/bin/composer
RUN composer install -o
RUN apt-get install -y mariadb-server
RUN service apache2 start