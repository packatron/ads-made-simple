#!/bin/bash
set -e
WORKDIR=$(echo $PWD)

mkdir -p ${WORKDIR}/dist
mkdir -p ${WORKDIR}/build
rm -fr ${WORKDIR}/build
mkdir -p ${WORKDIR}/build

cd ${WORKDIR}/build
git clone https://github.com/wp-quality/ads-made-simple

cd ${WORKDIR}/build/ads-made-simple
VERSION=$(cat composer.json | grep version | head -n 1 | sed 's/.*version//' | tr -d $'\n\r\t ,":=\'')

composer install --no-dev --prefer-dist

cd ${WORKDIR}/build
rm -f ../dist/ads-made-simple-${VERSION}.zip
zip -r ../dist/ads-made-simple-${VERSION}.zip ads-made-simple \
    -x "ads-made-simple/.git/*" \
       "ads-made-simple/.idea/*" \
       "ads-made-simple/dist/*" \
       "ads-made-simple/build/*" \
       "ads-made-simple/.*" \
       "ads-made-simple/Dockerfile" \
       "ads-made-simple/composer.*" \
       "ads-made-simple/wp-content/*" \
       "ads-made-simple/*.yml" \
       "ads-made-simple/*.sh"

rm -fr ${WORKDIR}/build
