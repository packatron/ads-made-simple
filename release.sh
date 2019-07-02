#!/bin/bash
set -e
WORKDIR=$(echo $PWD)

mkdir -p ${WORKDIR}/build
rm -fr ${WORKDIR}/build
mkdir -p ${WORKDIR}/build

cd ${WORKDIR}/build
git clone https://github.com/wp-quality/ads-made-simple

cd ${WORKDIR}/build/ads-made-simple
composer install --no-dev --prefer-dist

cd ${WORKDIR}/build
zip -r ../dist/ads-made-simple.zip ads-made-simple \
    -x "ads-made-simple/.git/*" "ads-made-simple/.idea/*"

#cd ${WORKDIR}
#rm -fr build
