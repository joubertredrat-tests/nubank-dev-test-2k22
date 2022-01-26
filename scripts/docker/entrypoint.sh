#!/bin/sh

php /var/www/html/composer.phar run coverage

php -S 0.0.0.0:8000 -t /var/www/html/tests/_reports/unit/coverage/