#!/bin/bash

[[ -d build ]] || mkdir build

cd build

git clone https://github.com/wp-quality/ads-made-simple

cd ads-made-simple

composer install

#rm -fr build
