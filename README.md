# pizza.com
delivered in 42 minutes, or it is free

## Version history

#### Release `v0.2` (most recent)
 Website has two pages:
 * main page with a list of pizzas;
 * admin page with simple CRUD functionality allows to create, update and delete each product.
 
 Authorization is not supported yet. 

#### Release `v0.1`
 There is only main page which contains list of pizzas with a simple responsive design.

## How to deploy this app

#### Deploy to pre-configured Ubuntu server

This scenario assumes that `pizza.com` domain is pre-configured
and all the files should be put into `htdocs` subdirectory.

```bash
cd /var/www/pizza.com
git clone https://github.com/OrlovVictor/pizza.com.git htdocs
chown -R :www-data htdocs
cd htdocs
composer update
chmod g+s storage/logs bootstrap/cache
nano .env   # Define server-specific settings such as database connection.
php artisan key:generate
php artisan migrate:fresh --seed
ln -s ../storage/app/public public/storage
```

#### Deploy as Heroku app

Either push the button:

[![Deploy](https://www.herokucdn.com/deploy/button.svg)](https://heroku.com/deploy)

... or follow these steps to deploy as Heroku app:

```
$ git clone https://github.com/OrlovVictor/pizza.com.git app
$ cd app
$ heroku create
$ git push heroku master:master
$ heroku open
```
