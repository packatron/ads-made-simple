#!/bin/bash

git add .
git commit -am "preparing publish"
git push

sleep 3

docker-compose build release
docker-compose run --rm release

git add .
git commit -am "publish release"
git push
