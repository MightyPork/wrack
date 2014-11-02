#!/bin/bash

NAME=wrack

rm -rf `find fontello-* -type d`

FONTELLO_ZIP=`find fontello-*.zip -maxdepth 0 -type f`

unzip $FONTELLO_ZIP

FONTELLO_DIR=`find fontello-* -maxdepth 0 -type d`

cp ${FONTELLO_DIR}/font/* ../public/fonts

cp ${FONTELLO_DIR}/css/fontello-${NAME}-ie7.css ../public/css/fontello-${NAME}-ie7.css
cat ${FONTELLO_DIR}/css/fontello-${NAME}.css | sed s#../font/#/fonts/# > ../public/css/fontello-${NAME}.css
