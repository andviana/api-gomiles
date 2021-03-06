#!/usr/bin/env bash

echo "Generating public and private keys used to sign JWT tokens.\n"

/bin/sh -c ' set -e apk add openssl
    mkdir -p config/jwt
    jwt_passhrase=$(grep ''^JWT_PASSPHRASE='' .env | cut -f 2 -d ''='')
    echo "$jwt_passhrase" | openssl genpkey -out config/jwt/private.pem -pass stdin -aes256 -algorithm rsa -pkeyopt rsa_keygen_bits:4096
    echo "$jwt_passhrase" | openssl pkey -in config/jwt/private.pem -passin stdin -out config/jwt/public.pem -pubout
    echo "Finish\n"
    ls -l config/jwt
'

echo "Finish.\n"