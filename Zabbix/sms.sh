#!/bin/bash
#GOIP4 SMS sent 

# echo $(( ( RANDOM % 4 )  + 1 ))
curl --request POST "http://ServerIP:3321/default/en_US/send.html" --data "u=admin&p=AsterisK&l=$(( ( RANDOM % 4 )  + 1 ))&n=$1&m=$2"
