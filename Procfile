<<<<<<< HEAD
release: ./heroku,release.sh
=======
release: cp .env.heroku .env
  cp .env.heroku .env
  php artisan key:generate
  php artisan migrate:fresh --seed
  php artisan storage:link
>>>>>>> 4cfdea50562d779d1eb7e09ce692a6cd08c81faf
web: vendor/bin/heroku-php-apache2 public/

