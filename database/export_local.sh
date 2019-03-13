#!/bin/bash
SOURCEDIR="$( cd "$( dirname "$0" )" && pwd )"

database=$(wp eval "echo env('DB_NAME');")
url=$(wp eval "echo env('BROWSER_SYNC_HOST');")

if [ "$database" = "" ]; then
  echo "DB_NAME not set in .env"
elif [ "$url" = "" ]; then
  echo "BROWSER_SYNC_HOST not set in .env"
else
  cd "$SOURCEDIR"
  "./_export.sh" "$database.sql" "https://$url"
fi
