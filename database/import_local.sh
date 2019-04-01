#!/bin/bash
SOURCEDIR="$( cd "$( dirname "$0" )" && pwd )"

cd "$SOURCEDIR"
database=$(wp eval "echo env('DB_NAME');"|xargs) # https://stackoverflow.com/a/12973694
url=$(wp eval "echo env('BROWSER_SYNC_HOST');"|xargs) # https://stackoverflow.com/a/12973694

if [ "$database" = "" ]; then
  echo "DB_NAME not set in .env"
elif [ "$url" = "" ]; then
  echo "BROWSER_SYNC_HOST not set in .env"
else
  "./_import.sh" "$database.sql" "https://$url"
fi
