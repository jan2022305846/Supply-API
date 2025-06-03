#!/bin/sh
# Install certificates if needed
apt-get update && apt-get install -y ca-certificates

# Run migrations and start the application
php artisan migrate --force
php artisan serve --host=0.0.0.0 --port=$PORT