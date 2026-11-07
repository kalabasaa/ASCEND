#!/bin/sh
set -e

echo "Waiting for MySQL at ${DB_HOST}:${DB_PORT}..."
until mysqladmin ping -h"${DB_HOST}" -P"${DB_PORT}" -u"${DB_USERNAME}" --silent 2>/dev/null; do
  sleep 2
done
echo "MySQL is up."

if [ ! -f .env ]; then
  cp .env.docker .env
fi

php artisan config:clear
php artisan migrate:fresh --seed --force

echo "Serving on 0.0.0.0:8000"
php artisan serve --host=0.0.0.0 --port=8000
