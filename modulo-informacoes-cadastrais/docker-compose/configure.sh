#!/bin/bash
sleep 10
php artisan migrate
php artisan db:seed