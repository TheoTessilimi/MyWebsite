#!/bin/sh
composer install
php bin/console doctrine:database:create
php bin/console --no-interaction d:m:m
php bin/console doctrine:database:create --env=test
php bin/console --no-interaction d:m:m --env=test
php bin/console --no-interaction doctrine:fixture:load --env=test
npm install
npm audit fix
npm run dev
echo "starting php-fpm"
# shellcheck disable=SC2068
exec $@