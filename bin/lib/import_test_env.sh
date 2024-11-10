#!/bin/bash

import_test_env()
{
  local CURRENT_DIR_ABSOLUTE_PATH
  CURRENT_DIR_ABSOLUTE_PATH="$( cd "$( dirname "${BASH_SOURCE[0]}" )" && pwd )"

  source "${CURRENT_DIR_ABSOLUTE_PATH}/../../.env"
  source "${CURRENT_DIR_ABSOLUTE_PATH}/../../.env.test"
  source "${CURRENT_DIR_ABSOLUTE_PATH}/../../.env.test.local"
}
import_test_env