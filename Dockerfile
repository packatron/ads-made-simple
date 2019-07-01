FROM php:7.2.19-cli

RUN apt-get update \
 && apt-get install --no-install-recommends -y git zip unzip \
 && apt-get clean && rm -rf /tmp/* /var/tmp/* && rm -rf /var/lib/apt/lists/*

WORKDIR /app
