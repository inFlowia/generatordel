#!/bin/bash

CURRENT_DIR_ABSOLUTE_PATH="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
source "${CURRENT_DIR_ABSOLUTE_PATH}/lib/wait_for_db_ready.sh"

drawSeparator()
{
  echo '============================================================'
}

docker-compose up -d
drawSeparator

# если в конфиге этого контейнера будет команда, она будет проигнорирована перед
# этим запуском
docker-compose run gendel_service_composer composer install
drawSeparator

waitForDbReady
drawSeparator
echo 'Starting project setup success checking script...'
bin/mini-check_project.sh
drawSeparator

echo 'Starting fixtures re-creation script...'
bin/recreate_fixtures.sh