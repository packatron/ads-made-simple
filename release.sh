#!/bin/bash
set -e
WORKDIR=$(echo $PWD)

mkdir -p build

cd build
git clone https://github.com/wp-quality/ads-made-simple

cd ads-made-simple
composer install

cd ${WORKDIR}
rm -fr build
