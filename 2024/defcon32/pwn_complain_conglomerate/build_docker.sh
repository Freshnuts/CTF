#!/bin/bash

docker build --tag=complaint_conglomerate .
docker run -it -p 1337:1337 --rm --name=complaint_conglomerate complaint_conglomerate