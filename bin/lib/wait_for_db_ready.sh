#!/bin/bash

waitForDbReady()
{
  local CURRENT_DIR_ABSOLUTE_PATH
  CURRENT_DIR_ABSOLUTE_PATH="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
  source "${CURRENT_DIR_ABSOLUTE_PATH}/import_test_env.sh"

  local DB_READY_CHECKING_TIMEOUT_SEC=60
  local DB_READY_CHECKING_INTERVAL_SEC=2

  local elapsedTime=0

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

    local exitCode=$?

    if [[ $exitCode -eq 0 ]]
    then
      echo "MySQL is ready!"

      return 0
    fi

    sleep $DB_READY_CHECKING_INTERVAL_SEC
    local elapsedTime=$((elapsedTime + DB_READY_CHECKING_INTERVAL_SEC))
  done

    echo "Error: MySQL did not become ready within ${DB_READY_CHECKING_TIMEOUT_SEC} seconds."
    return 1
}