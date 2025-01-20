#!/bin/bash

CURRENT_DIR_ABSOLUTE_PATH="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
source "${CURRENT_DIR_ABSOLUTE_PATH}/lib/wait_for_db_ready.sh"
source "${CURRENT_DIR_ABSOLUTE_PATH}/lib/cli_decor.sh"

docker-compose up -d --build
drawSeparator

# если в конфиге этого контейнера будет команда, она будет проигнорирована перед
# этим запуском
docker-compose run gendel_service_composer composer install
drawSeparator

waitForDbReady
drawSeparator
currentCheckName='Project setup success checking script'
echo "Starting ${currentCheckName}..."
bin/mini-check_project.sh
currentExitCode=$?
if [[ $currentExitCode -ne 0 ]]
then
  showError "${currentCheckName} finished with error!"
  exit 1
fi
drawSeparator

echo 'Starting fixtures re-creation script...'
bin/recreate_fixtures.sh