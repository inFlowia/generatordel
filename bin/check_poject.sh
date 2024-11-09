#!/bin/bash
CURRENT_DIR_ABSOLUTE_PATH="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

"${CURRENT_DIR_ABSOLUTE_PATH}/mini-check_project.sh"
"${CURRENT_DIR_ABSOLUTE_PATH}/test.sh"