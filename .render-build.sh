#!/usr/bin/env bash
set -e

composer install --no-interaction --no-dev --prefer-dist --optimize-autoloader

php artisan config:clear
php artisan route:clear
php artisan view:clear
php artisan cache:clear
php artisan storage:link || true

php artisan config:cache
php artisan route:cache
php artisan view:cache
