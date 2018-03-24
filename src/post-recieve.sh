#!/bin/bash
 
DIR=$(git rev-parse --show-toplevel)
DIR="$DIR/src"
if [ -e "$DIR/composer.json" ]; then
    if [ -d "$DIR/vendor" ]; then
        composer install
    else
        composer update
    fi
fi