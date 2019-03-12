#!/bin/bash
SOURCEDIR="$( cd "$( dirname "$0" )" && pwd )"

"$SOURCEDIR/_import.sh" project.sql https://project.test
