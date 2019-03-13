#!/bin/bash
SOURCEDIR="$( cd "$( dirname "$0" )" && pwd )"

if [ $# -gt 1 ]
then
  DESTINATION_SQL=$1
  old=$2
  new=${3:-ROOTURL} # https://stackoverflow.com/a/2013589/1109380

  # Use wp-cli from local composer
  wp="$SOURCEDIR/../vendor/wp-cli/wp-cli/bin/wp"

  echo "Using $wp:"
  "$wp" cli version

  cd "$SOURCEDIR"

  echo ""
  echo "Cleaning up"
  "$wp" db query < cleanup.sql

  echo ""
  echo "Replacing $old to $new in database and exporting to $DESTINATION_SQL"
  "$wp" search-replace $old $new --all-tables --report-changed-only --export="$DESTINATION_SQL"
else
  echo "Expected at least two parameters";
fi

echo ""
read -p "Press ENTER to exit..."
