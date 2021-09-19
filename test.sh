#!/bin/bash

sudo php bin/console doctrine:database:drop --force --env=test
sudo php bin/console doctrine:database:create --env=test
sudo php bin/console doctrine:schema:create --env=test
sudo php bin/console doctrine:fixtures:load --env=test --no-interaction

./vendor/bin/simple-phpunit
