#!/usr/bin/env bash
set -e

echo "Discovering packages..."
php artisan package:discover --ansi || true

echo "Clearing caches..."
php artisan optimize:clear || true

echo "Running migrations and seeders..."
php artisan migrate --force --seed

echo "Starting server on port ${PORT:-10000}..."
php -S 0.0.0.0:${PORT:-10000} -t public
