FROM php:8.0-alpine

RUN apk add --no-cache $PHPIZE_DEPS \
    && pecl install xdebug-3.1.2 \
    && docker-php-ext-enable xdebug

COPY . /var/www/html

RUN chown -Rf www-data:www-data /var/www/html

USER www-data

WORKDIR /var/www/html

RUN php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');" && \
    php composer-setup.php && \
    php -r "unlink('composer-setup.php');"

RUN php composer.phar install

ENTRYPOINT ["sh", "/var/www/html/scripts/docker/entrypoint.sh"]