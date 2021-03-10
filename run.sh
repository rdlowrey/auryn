#!/bin/sh

cd /srv
composer update --with-all-dependencies

vendor/bin/phpunit "$@"