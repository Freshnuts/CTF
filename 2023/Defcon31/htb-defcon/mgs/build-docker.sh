#!/bin/sh
docker build --tag=mgs .
docker run -it -p 1337:1337 --rm --name=mgs mgs