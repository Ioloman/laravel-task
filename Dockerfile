FROM php:latest
WORKDIR /var/www/html/

RUN apt-get update && apt-get install -y zip unzip libpng-dev libonig-dev libxml2-dev
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
RUN php -r "if (hash_file('sha384', 'composer-setup.php') === '756890a4488ce9024fc62c56153228907f1545c228516cbf63f885e036d37e9a59d27d63f46af1d4d07ee0f76181c7d3') { echo 'Installer verified'; } else { echo 'Installer corrupt'; unlink('composer-setup.php'); } echo PHP_EOL;"
RUN php composer-setup.php
RUN php -r "unlink('composer-setup.php');"

RUN php composer.phar create-project --prefer-dist laravel/laravel:^7.0 task

EXPOSE 8000
EXPOSE 22

CMD cd task/ && php artisan serve --host=0.0.0.0 --port=8000

