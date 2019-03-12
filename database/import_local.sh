#!/bin/bash
SOURCEDIR="$( cd "$( dirname "$0" )" && pwd )"

cd "$SOURCEDIR"
"./_import.sh" $(wp eval "echo env('DB_NAME');").sql https://$(wp eval "echo env('BROWSER_SYNC_HOST');")
