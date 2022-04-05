tiny_reservation_system
=======================

Very simple and tiny reservation system for agility trainings

## Prerequisites
* `docker` installed

## Run in docker
Call this command in the root folder of the project
```
docker-compose up
```

Then go to the url `http://localhost:8100/web/app.php/` to access the home page.
You probably will see the empty page.
Follow the steps in installation section below.

### Install composer depenedcies
First attach your terminal into the running docker container

```
docker-compose exec web bash
```

The you can create the database schema by command

```
php -f bin/console doctrine:schema:create
```

### Clear the cache
Inside the running docker container
```
php -f bin/console clear:cache --env=prod
```

## Run Unit Tests
```
./vendor/bin/simple-phpunit
```
