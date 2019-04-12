#!/bin/bash
SOURCEDIR="$( cd "$( dirname "$0" )" && pwd )"

cd "$SOURCEDIR"

# Use wp-cli from local composer
wp="$SOURCEDIR/../vendor/wp-cli/wp-cli/bin/wp"

"./_migrate.sh" domain.tld $("$wp" eval "echo env('BROWSER_SYNC_HOST');"|xargs) https://domain.tld
