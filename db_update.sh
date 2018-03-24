#!/bin/bash

. credientials.sh

FILE_PATH=''

UPDATE=''

if [ -d "$DIRECTORY" ]; then

        # grabs most recently edited file in update dir
        FILE_PATH=$DIRECTORY/$(ls -t1 $DIRECTORY |  head -n 1)

        # reads contents of the file
        UPDATE=$(<$FILE_PATH)
fi

mysql -u $DB_USER -p$DB_PASS -Bse "USE $DB_NAME; $UPDATE"
