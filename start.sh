#!/usr/bin/env bash
set -e

echo "Discovering packages..."
rm -f bootstrap/cache/*.php
php artisan package:discover --ansi || true

echo "Clearing caches..."
php artisan optimize:clear || true

echo "Running migrations..."
php artisan migrate --force

echo "Seeding database..."
php artisan db:seed --force

echo "Starting server on port ${PORT:-10000}..."
php -S 0.0.0.0:${PORT:-10000} -t public
