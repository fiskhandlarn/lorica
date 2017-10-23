#!/bin/bash
SOURCEDIR="$( cd "$( dirname "$0" )" && pwd )"

MYSQL="/cygdrive/c/Program Files/MySQL/MySQL Server 5.7/bin/mysql"
SOURCE_SQL="we-are-hiring.sql"
DATABASE="we-are-hiring"
REGEXP="s/ROOTURL/https:\/\/we-are-hiring\.dev/g"

echo ""
echo -n "Are you sure? [Y/n] "

read addAuth
if [ "$addAuth" == "y" ] || [ "$addAuth" == "Y" ] || [ "$addAuth" == "" ]; then
  MYSQL_PWD=password "$MYSQL" -u root -e "drop database \`$DATABASE\`";
  MYSQL_PWD=password "$MYSQL" -u root -e "create database \`$DATABASE\`";
  cp "$SOURCEDIR/$SOURCE_SQL" "$SOURCEDIR/temp.sql"
  sed -i $REGEXP "$SOURCEDIR/temp.sql"
  MYSQL_PWD=password "$MYSQL" -u root "$DATABASE" < "$SOURCEDIR/temp.sql"
  rm "$SOURCEDIR/temp.sql"
fi

echo ""
read -p "Press ENTER to exit..."
