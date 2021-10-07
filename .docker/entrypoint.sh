#!/bin/bash
composer install
php artisan cache:clear
chmod -R 777 storage
chmod -R 777 bootstrap
chmod -R 777 vendor
php artisan migrate
php artisan key:generate --force
#php artisan passport:install
#php artisan migrate:fresh --seed
php artisan storage:link
php-fpm
