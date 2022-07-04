```
docker-compose up -d
```
For connecting to `php` container command prompt run: 
```
docker-compose exec php bash
```
Running doctrine migration 
php bin/console doctrine:migrations:migrate
```
Loading fixture 
php bin/console doctrine:fixtures:load
