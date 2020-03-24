#!/bin/bash

# Create a .env file
cp /var/www/html/.env.default /var/www/html/.env

# Composer install
cd /var/www/html && composer install

# Change www folder user to apache user
chown -R www-data:www-data /var/www/html

# Generate app encryption key
php artisan key:generate

# Run migrations
php artisan migrate:refresh --seed

# Start apache in foreground
/usr/sbin/apache2ctl -D FOREGROUND
