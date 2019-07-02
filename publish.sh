#!/bin/bash

git add .
git commit -am "publish"
git push

sleep 3

docker-compose build release
docker-compose run --rm release
