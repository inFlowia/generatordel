#!/bin/bash

docker-compose up -d
docker exec -it gendel_container_composer composer install
bin/c