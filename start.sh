#!/usr/bin/env bash

echo "Preparing SQLite database..."
touch database/database.sqlite

echo "Running migrations and seeders..."
php artisan migrate:fresh --seed --force

echo "Starting server..."
php -S 0.0.0.0:${PORT:-8000} -t public
