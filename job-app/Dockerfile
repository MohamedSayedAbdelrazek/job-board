FROM laravelsail/php83-composer

WORKDIR /var/www/html

RUN docker-php-ext-install pdo pdo_mysql

COPY . .

RUN composer install
