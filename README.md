[![Build Status](https://travis-ci.org/seeren/universal-code-description.svg?branch=master)](https://travis-ci.org/seeren/universal-code-description) [![GitHub license](https://img.shields.io/badge/license-MIT-orange.svg)](https://raw.githubusercontent.com/seeren/view/master/LICENSE) [![GitHub tag](https://img.shields.io/github/tag/seeren/universal-code-description.svg)](https://github.com/seeren/universal-code-description/releases)

# UniversalCodeDescription
Propose an universal interface for code description.

## Demo
Target with a PHP or JS  repository name in uri path like  [seeren/universal-code-description](http://universal-code-description.alwaysdata.net/seeren/universal-code-description).
```
{
    "distribuable": false,
    "testable": true,
    "langage": "php",
    "vendor": "seeren",
    "repository": "universal-code-description",
    "package": "seeren\/universal-code-description",
    "description": "An universal interface for code description",
    "keywords": [
        "repository-description",
        "package-description"
    ],
    "type": "project",
    "homepage": "",
    "dependencies": [],
    "devDependencies": [
        "phpunit\/phpunit"
    ],
    "version": [],
    "license": "MIT",
    "author": "Cyril"
}
```
A short description per repository based on package.json or composer.json check if the code is available on nmp or packagist and travis.

## Installation
Clone this repository
```
git clone https://github.com/seeren/universal-code-description.git
```

## Run the tests
Run with phpunit after install dependencies
```
composer update
phpunit
```

## Authors
* **Cyril Ichti** - [www.seeren.fr](http://www.seeren.fr)