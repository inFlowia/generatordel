#!/bin/bash

CURRENT_DIR_ABSOLUTE_PATH="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
source "${CURRENT_DIR_ABSOLUTE_PATH}/lib/wait_for_db_ready.sh"

docker-compose up -d gendel_service_php
waitForDbReady

docker exec -it gendel_container_php vendor/bin/phpunit "$1"