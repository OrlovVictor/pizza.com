release:
  cp .env.heroku .env
  php artisan key:generate
  php artisan migrate:fresh --seed
  php artisan storage:link
web: vendor/bin/heroku-php-apache2 public/

