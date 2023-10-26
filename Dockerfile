FROM php:8.2

RUN apt-get update && apt-get install -y git

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

RUN apt-get install -y libpq-dev
RUN apt-get install -y unzip
RUN docker-php-ext-configure pgsql -with-pgsql=/usr/local/pgsql
RUN docker-php-ext-install pdo pdo_pgsql

ARG CACHEBUST=1

WORKDIR /app

COPY . .

RUN composer update

WORKDIR /app/src/public

CMD ["php", "-S", "0.0.0.0:8000"]
