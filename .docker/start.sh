#!/bin/sh

# Start supervisor
/usr/bin/supervisord -n -c /etc/supervisor/supervisord.conf &

# Start PHP-FPM
php-fpm 