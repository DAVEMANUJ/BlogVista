#!/usr/bin/env bash
set -e

echo "Clearing caches..."
php artisan optimize:clear || true

echo "Running migrations and seeders..."
php artisan migrate --force --seed

echo "Caching config..."
php artisan config:cache
php artisan route:cache
php artisan view:cache

echo "Starting server..."
php -S 0.0.0.0:${PORT:-10000} -t public
