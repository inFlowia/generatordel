#!/bin/bash

bin/console cache:clear --env=test --no-warmup
bin/console doctrine:database:drop --env=test --if-exists --force
bin/console doctrine:database:create --env=test
bin/console doctrine:schema:create --env=test
bin/console doctrine:fixtures:load --env=test --append --verbose --no-interaction