#!/usr/bin/env bash
export APP_ENV=test
php /var/www/bin/phpunit /var/www/tests/ -c /var/www/phpunit.xml.dist
export APP_ENV=dev