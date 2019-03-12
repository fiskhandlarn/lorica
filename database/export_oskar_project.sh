#!/bin/bash
SOURCEDIR="$( cd "$( dirname "$0" )" && pwd )"

"$SOURCEDIR/_export.sh" project.sql https://project.test
