 #!/usr/bin/env bash

echo "Preparing storage and cache directories..."

mkdir -p storage/framework/cache/data
mkdir -p storage/framework/views
mkdir -p storage/logs
mkdir -p bootstrap/cache

chmod -R 775 storage bootstrap/cache
chown -R www-data:www-data storage bootstrap/cache || true

echo "Running composer install..."
composer install --no-dev --working-dir=/var/www/html

echo "Caching config..."
php artisan config:cache

echo "Caching routes..."
php artisan route:cache

echo "Publishing cloudinary provider..."
php artisan vendor:publish --provider="CloudinaryLabs\CloudinaryLaravel\CloudinaryServiceProvider" --tag="cloudinary-laravel-config"

echo "Running migrations..."
php artisan migrate --force
