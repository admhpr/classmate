#!/bin/bash

# source credientials 
. credientials.sh

# backup file name
FILE=$DB_NAME.$(date +"%Y-%m-%d").sql.gz

# setup
FILE_PATH=''
UPDATE=''

# backup current db
mkdir -p ~/db_backups
mysqldump --opt --user=${DB_USER} --password=${DB_PASS} ${DB_NAME} 2>&1 | grep -v "Warning: Using a password" | gzip > ~/db_backups/${FILE}

echo backup made: $(ls -lah ~/db_backups/${FILE})

# update
if [ -d "$DIRECTORY" ]; then

        # grabs most recently edited file in update dir
        FILE_PATH=$DIRECTORY/$(ls -t1 $DIRECTORY |  head -n 1)

        # reads contents of the file
        UPDATE=$(<$FILE_PATH)
fi

while true; do
    read -p "The following command is about to run on the db: $UPDATE. Continue?(y/n)" yn
    case $yn in
        [Yy]* ) mysql -u $DB_USER -p$DB_PASS -Bse "USE $DB_NAME; $UPDATE" 2> /dev/null ; break;;
        [Nn]* ) exit;;
        * ) echo "Please answer yes(y) or no(n).";;
    esac
done