FROM php:8.3.2-fpm-alpine3.19
WORKDIR /var/www/html

ADD ./php/www.conf /usr/local/etc/php-fpm.d/www.conf

RUN addgroup -g 1000 laravel && adduser -G laravel -g laravel -s /bin/sh -D laravel

RUN mkdir -p /var/www/html

ADD . /var/www/html

RUN apk add --no-cache $PHPIZE_DEPS \
    freetype-dev \
    libjpeg-turbo-dev \
    libpng-dev \
    libwebp-dev \
    libxpm-dev \
    libzip-dev \
    gettext-dev \
    oniguruma-dev

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

RUN docker-php-ext-install pdo pdo_mysql gettext gd

RUN docker-php-ext-configure gd --enable-gd --with-freetype --with-jpeg && \
    docker-php-ext-install -j$(nproc) gd

# Limit the upload size and number of files
RUN echo "max_file_uploads=100" >> /usr/local/etc/php/conf.d/docker-php-ext-max_file_uploads.ini

RUN echo "post_max_size=20M" >> /usr/local/etc/php/conf.d/docker-php-ext-post_max_size.ini

RUN echo "upload_max_filesize=20M" >> /usr/local/etc/php/conf.d/docker-php-ext-upload_max_filesize.ini

RUN chown -R laravel:laravel /var/www/html
