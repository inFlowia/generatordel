#!/bin/bash

CURRENT_DIR_ABSOLUTE_PATH="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"
source "${CURRENT_DIR_ABSOLUTE_PATH}/lib/import_test_env.sh"
CURRENT_DIR_ABSOLUTE_PATH="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

docker exec -it "$PHP_CONTAINER_NAME" bin/console gendel:mini_check