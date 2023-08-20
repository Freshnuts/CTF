#!/bin/sh
docker build --tag=item_shop .
docker run -it -p 1337:1337 --rm --name=item_shop item_shop