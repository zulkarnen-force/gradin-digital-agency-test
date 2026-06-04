#!/bin/sh
set -e

echo "Waiting for database..."
sleep 5

echo "Running migrations..."
php artisan migrate --force

echo "Running seeders..."
php artisan db:seed --force

# Optional
if [ "${APP_SEED:-false}" = "true" ]; then
    echo "Running seeders..."
    php artisan db:seed --force
fi

exec "$@"