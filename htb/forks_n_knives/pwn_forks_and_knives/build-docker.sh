#!/bin/sh

docker build -t pwn_forks_and_knives .

docker run -p 1337:1337 -d --name pwn_forks_and_knives --rm pwn_forks_and_knives
