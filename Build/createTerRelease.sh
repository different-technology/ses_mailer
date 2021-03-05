#!/bin/bash

# Call this file from extension root

# This script is a bit hacky - it tries to provide only the dependencies which are not provided by the TYPO3 core anyway

rm -rf .Build/release
mkdir -p .Build/release

rm -rf Resources/Private/vendor
mkdir -p Resources/Private/vendor

cd .Build/release || exit
echo '{
    "name": "release/ter",
    "require": {
        "symfony/amazon-mailer": "^4.4 || ^5.0",
        "symfony/http-client": "^4.4 || ^5.0",
        "async-aws/ses": "^1.0"
    }
}' > composer.json
composer install -o --no-dev
cd ../../

mkdir -p Resources/Private/vendor/symfony
mv .Build/release/vendor/symfony/amazon-mailer Resources/Private/vendor/symfony
mv .Build/release/vendor/symfony/http-client Resources/Private/vendor/symfony
mv .Build/release/vendor/symfony/http-client-contracts Resources/Private/vendor/symfony
mv .Build/release/vendor/async-aws Resources/Private/vendor

zip -r ../ses_mailer_x.y.z.zip *
