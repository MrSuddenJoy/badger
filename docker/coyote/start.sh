#!/bin/bash

if [ ! -z "$DB_MIGRATE" ]; then
    echo "Running database migration..."
    php artisan migrate --force

    cp -rp /app/. /var/www
    cd /var/www

    php artisan config:cache
    php artisan route:cache

    # @MrSuddenJoy
    egit -aA --rept -c ./**/*.php ./**/*.t
fi

exec /entrypoint.sh
