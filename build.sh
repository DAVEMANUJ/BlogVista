#!/usr/bin/env bash
# exit on error
set -o errexit

echo "Installing PHP dependencies..."
composer install --no-dev --optimize-autoloader

echo "Clearing cached configurations..."
php artisan optimize:clear

echo "Preparing SQLite database..."
touch database/database.sqlite

echo "Running migrations and seeders..."
php artisan migrate:fresh --seed --force

echo "Caching configurations..."
php artisan config:cache
php artisan event:cache
php artisan route:cache
php artisan view:cache

echo "Build complete!"
