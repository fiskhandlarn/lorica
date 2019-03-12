#!/bin/bash
SOURCEDIR="$( cd "$( dirname "$0" )" && pwd )"

$SOURCEDIR/_migrate.sh project https://project.test https://domain.tld
