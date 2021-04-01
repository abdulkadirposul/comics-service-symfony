# comics-service-symfony
This project is created to complete a code challenge of Seven Senders by using symfony framework

# installation
please follow the steps mentioned below:
```
git clone https://github.com/abdulkadirposul/comics-service-symfony.git
cd ccomics-service-symfony
docker-compose up -d
docker-compose exec src composer update
docker-compose exec src chgrp -R www-data var
docker-compose exec src chown -R www-data:www-data ./var
docker-compose exec src chmod -R 0777 ./var
```

#test
You can run unit and feature tests as mentioned below. (Note that for the first time it is going to install necessary packets for phpunit and testing)
```
docker-compose exec src php bin/phpunit
```

# navigation
You can get more info via one of the following links
- <a href="http://127.0.0.1:8080">Homepage</a>
- <a href="http://127.0.0.1:8080/api/doc">Swagger Documentation</a>
- <a href="http://127.0.0.1:8080/api/comics">Comics Service</a>