# Docker

### Start PHPMyAdmin + Database Server
```
docker-compose up
```

### Remove all container
```
docker-compose down
```

### Remove all images
```
docker rmi -f $(docker images -a -q)
```

### Remove all volumes
```
docker volume rm $(docker volume ls -q)
```

# Database

* To create database ,schema and make fixture on env.test add `--env=test`  after `php bin/console`

### Create database
``` 
php bin/console doctrine:database:create
```

### Make migration
``` 
php bin/console make:migration
```

### Apply Migration
```
php bin/console doctrine:migrations:migrate
```

### Apply Fixtures
```
php bin/console doctrine:fixtures:load
```

# Super command ()

```
docker-compose down; docker rmi -f $(docker images -a -q); docker volume rm $(docker volume ls -q); docker-compose up

php bin/console doctrine:database:create; php bin/console make:migration; php bin/console doctrine:migrations:migrate; php bin/console doctrine:fixtures:load

php bin/console --env=test doctrine:database:create; php bin/console --env=test doctrine:migrations:migrate; php bin/console --env=test doctrine:fixtures:load
```