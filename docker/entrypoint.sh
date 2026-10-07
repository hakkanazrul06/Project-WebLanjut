#!/bin/sh
set -e

# Ensure SQLite database exists if using sqlite
if [ "$DB_CONNECTION" = "sqlite" ] || [ -z "$DB_CONNECTION" ]; then
    mkdir -p /var/www/database
    touch /var/www/database/database.sqlite
    chown -R www-data:www-data /var/www/database
fi

# Cache configuration, routes, and views for production performance
php artisan config:cache || true
php artisan route:cache || true

# Run database migrations
php artisan migrate --force

# Ensure proper permissions
chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Start PHP-FPM in background
php-fpm -D

# Start Nginx in foreground
exec nginx -g "daemon off;"
