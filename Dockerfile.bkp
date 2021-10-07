FROM php:7.3.7-fpm-alpine3.10
RUN apk add --no-cache openssl bash mysql-client nano libxml2-dev libpng-dev

RUN apk add --no-cache zip libzip-dev

RUN docker-php-ext-configure zip --with-libzip

RUN docker-php-ext-install pdo pdo_mysql soap bcmath gd calendar && docker-php-ext-configure calendar
RUN docker-php-ext-install zip

ENV DOCKERIZE_VERSION v0.6.1
RUN wget https://github.com/jwilder/dockerize/releases/download/$DOCKERIZE_VERSION/dockerize-alpine-linux-amd64-$DOCKERIZE_VERSION.tar.gz \
    && tar -C /usr/local/bin -xzvf dockerize-alpine-linux-amd64-$DOCKERIZE_VERSION.tar.gz \
    && rm dockerize-alpine-linux-amd64-$DOCKERIZE_VERSION.tar.gz

WORKDIR /var/www

RUN rm -rf /var/www/html

RUN ln -s public html

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

#RUN composer install

EXPOSE 9000

ENTRYPOINT ["php-fpm"]
