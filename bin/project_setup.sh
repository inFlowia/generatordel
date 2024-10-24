#!/bin/bash

docker-compose up -d
docker exec -it gendel_composer composer install
bin/c