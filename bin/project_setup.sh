#!/bin/bash

docker-compose up -d

# если в конфиге этого контейнера будет команда, она будет проигнорирована перед
# этим запуском
docker-compose run gendel_service_composer composer install

echo 'Starting project setup success checking script...'
bin/c