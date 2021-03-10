#!/bin/sh

EXPECTED_SIGNATURE=$(wget https://composer.github.io/installer.sig -O - -q)
/usr/local/bin/php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
ACTUAL_SIGNATURE=$(/usr/local/bin/php -r "echo hash_file('SHA384', 'composer-setup.php');")

if [ "$EXPECTED_SIGNATURE" = "$ACTUAL_SIGNATURE" ]
then
    /usr/local/bin/php composer-setup.php
    RESULT=$?
    exit $RESULT
else
    >&2 echo 'ERROR: Invalid installer signature'
    exit 1
fi