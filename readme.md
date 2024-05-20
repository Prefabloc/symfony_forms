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

