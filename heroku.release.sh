#!/bin/bash
cp .env.heroku .env
php artisan key:generate
php artisan migrate:fresh --seed
php artisan storage:link
