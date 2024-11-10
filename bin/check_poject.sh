#!/bin/bash
CURRENT_DIR_ABSOLUTE_PATH="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
source "${CURRENT_DIR_ABSOLUTE_PATH}/lib/cli_decor.sh"
CURRENT_DIR_ABSOLUTE_PATH="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

currentCheckName='Minimal Check of application functionality'
echo "${currentCheckName} starting..."
"${CURRENT_DIR_ABSOLUTE_PATH}/mini-check_project.sh"
currentExitCode=$?
if [[ $currentExitCode -ne 0 ]]
then
  showError "${currentCheckName} finished with error!"
  exit 1
fi
drawSeparator

echo "PHPUnit Tests starting..."
echo
"${CURRENT_DIR_ABSOLUTE_PATH}/test.sh"
drawSeparator

echo "Doctrine Schema Validation starting..."
docker exec -it gendel_container_php bin/console doctrine:schema:validate
drawSeparator