#!/bin/bash
set -e
WORKDIR=$(echo $PWD)

mkdir -p build
rm -fr build
mkdir -p build

cd build
git clone https://github.com/wp-quality/ads-made-simple

cd ads-made-simple
composer install --no-dev --prefer-dist

#cd ${WORKDIR}
#rm -fr build
