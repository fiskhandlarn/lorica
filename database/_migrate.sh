#!/bin/bash
SOURCEDIR="$( cd "$( dirname "$0" )" && pwd )"

if [ $# -eq 3 ]
then
  mkdir -p "$SOURCEDIR/migrate"
  "$SOURCEDIR/_export.sh" "migrate/$1.$(date +%Y-%m-%d).sql" $2 $3
else
  echo "Expected exactly three parameters";
fi
