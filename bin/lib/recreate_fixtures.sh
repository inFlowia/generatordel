#!/bin/bash

bin/console cache:clear --env=test --no-warmup
bin/console doctrine:database:drop --env=test --if-exists --force
bin/console doctrine:database:create --env=test

echo
echo Database schema creation started
bin/console doctrine:schema:create --env=test

echo Fixture loading started
echo
bin/console doctrine:fixtures:load --env=test --append --verbose --no-interaction