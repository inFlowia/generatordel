#!/bin/bash
CURRENT_DIR_ABSOLUTE_PATH="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
source "${CURRENT_DIR_ABSOLUTE_PATH}/lib/cli_decor.sh"

echo "Minimal Check of application functionality starting..."
"${CURRENT_DIR_ABSOLUTE_PATH}/mini-check_project.sh"
drawSeparator

echo "PHPUnit Tests starting..."
echo
"${CURRENT_DIR_ABSOLUTE_PATH}/test.sh"
drawSeparator

echo "Doctrine Schema Validation starting..."
docker exec -it gendel_container_php bin/console doctrine:schema:validate