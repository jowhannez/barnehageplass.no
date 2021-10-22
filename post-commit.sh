#!/bin/bash

# exit on errors
set -e

composer install --no-interaction
npm ci
npm run prod