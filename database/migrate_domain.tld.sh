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

"./_migrate.sh" domain.tld $("$wp" eval "echo env('BROWSER_SYNC_HOST');"|xargs) https://domain.tld
