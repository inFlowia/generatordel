#!/bin/bash

DB_READY_CHECKING_TIMEOUT_SEC=60
DB_READY_CHECKING_INTERVAL_SEC=2

CURRENT_DIR_ABSOLUTE_PATH="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
source "${CURRENT_DIR_ABSOLUTE_PATH}/../.env"
source "${CURRENT_DIR_ABSOLUTE_PATH}/../.env.test"
source "${CURRENT_DIR_ABSOLUTE_PATH}/../.env.test.local"

drawSeparator()
{
  echo '============================================================'
}

waitForDbReady()
{
  elapsedTime=0

  while [[ $elapsedTime -lt $DB_READY_CHECKING_TIMEOUT_SEC ]]
  do
    echo "Waiting for MySQL..."

    # Эта проверка иногда отвечает успехом раньше готовности к подключению
    # doctrine:
    #    docker exec "$DB_CONTAINER_NAME" mysqladmin ping\
    #     --user="$MYSQL_USER"\
    #     --password="$MYSQL_PASSWORD"\
    #     --silent
    # Проверка при помощи запроса надёжнее
    docker exec "$DB_CONTAINER_NAME" mysql\
      --user="$MYSQL_USER"\
      --password="$MYSQL_PASSWORD"\
      --execute="SELECT 'Some response from DB';"\
      --silent

    exitCode=$?

    if [[ $exitCode -eq 0 ]]
    then
      echo "MySQL is ready!"

      return 0
    fi

    sleep $DB_READY_CHECKING_INTERVAL_SEC
    elapsedTime=$((elapsedTime + DB_READY_CHECKING_INTERVAL_SEC))
  done

    echo "Error: MySQL did not become ready within ${DB_READY_CHECKING_TIMEOUT_SEC} seconds."
    return 1
}

# ==============================================================================

docker-compose up -d
drawSeparator

# если в конфиге этого контейнера будет команда, она будет проигнорирована перед
# этим запуском
docker-compose run gendel_service_composer composer install
drawSeparator

waitForDbReady
drawSeparator
echo 'Starting project setup success checking script...'
bin/c