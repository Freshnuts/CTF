#!/bin/sh
docker build --tag=artifact .
docker run -it -p 1337:1337 --rm --name=artifact artifact
