FROM php:8.1-fpm

WORKDIR /var/www/html

# Arguments defined in docker-compose.yml
# ARG user
# ARG uid

RUN apt-get update && apt-get install -y zlib1g-dev libicu-dev libzip-dev zip unzip libpng-dev libssl-dev pkg-config

RUN docker-php-ext-install -j$(nproc) gd
RUN docker-php-ext-install zip
RUN docker-php-ext-install intl opcache pdo pdo_mysql


# RUN pecl install mongodb
# RUN docker-php-ext-install bcmath
# RUN echo "extension=mongodb.so" >> /usr/local/etc/php/conf.d/mongodb.ini

RUN pecl install mongodb
RUN docker-php-ext-enable mongodb

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

COPY composer.json ./
COPY composer.lock ./

COPY . .

ENV COMPOSER_ALLOW_SUPERUSER=1

RUN composer install
RUN php artisan key:generate

EXPOSE 9000
CMD ["php", "artisan", "serve", "--host", "0.0.0.0", "--port=8000"]
