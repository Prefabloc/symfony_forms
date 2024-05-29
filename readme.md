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

