#!/bin/bash

file="lib3"
file2="lib3_noSymbols"

mkdir list

while read -r line
do
  echo "$line"
  curl "https://libc.blukat.me/d/$line" > list/$line
  sleep 1
done < "$file"

