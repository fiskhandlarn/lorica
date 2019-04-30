#!/bin/bash
SOURCEDIR="$( cd "$( dirname "$0" )" && pwd )"

cd "$SOURCEDIR"

# https://stackoverflow.com/a/25518345/1109380
if [ -f /.dockerenv ]; then
  wp="wp"
else
  # Use wp-cli from local composer
  wp="$SOURCEDIR/../vendor/wp-cli/wp-cli/bin/wp"
fi

database=$("$wp" eval "echo env('DB_NAME');"|xargs) # https://stackoverflow.com/a/12973694
url=$("$wp" eval "echo env('BROWSER_SYNC_HOST');"|xargs) # https://stackoverflow.com/a/12973649

echo $database
echo $url

if [ "$database" = "" ]; then
  echo "DB_NAME not set in .env"
elif [ "$url" = "" ]; then
  echo "BROWSER_SYNC_HOST not set in .env"
else
  "./_export.sh" "$database.sql" "$url"
fi
