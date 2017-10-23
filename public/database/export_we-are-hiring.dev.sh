#!/bin/bash
SOURCEDIR="$( cd "$( dirname "$0" )" && pwd )"

MYSQL="/cygdrive/c/Program Files/MySQL/MySQL Server 5.7/bin/mysql"
MYSQLDUMP="/cygdrive/c/Program Files/MySQL/MySQL Server 5.7/bin/mysqldump"
DESTINATION_SQL="we-are-hiring.sql"
DATABASE="we-are-hiring"
REGEXP="s/https:\/\/we-are-hiring\.dev/ROOTURL/g"

"$MYSQL" -u root --password=password "$DATABASE" < "$SOURCEDIR/cleanup.sql"
"$MYSQLDUMP" -u root --password=password "$DATABASE" | sed 's$),($),\n($g' > "$SOURCEDIR/$DESTINATION_SQL"
sed -i $REGEXP "$SOURCEDIR/$DESTINATION_SQL"

echo ""
read -p "Press ENTER to exit..."
