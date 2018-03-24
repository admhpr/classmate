#!/bin/bash
 
DIR=$(git rev-parse --show-toplevel)
 
if [ -e "$DIR/composer.json" ]; then
    if [ -d "$DIR/vendor" ]; then
        composer install
    else
        composer update
    fi
fi