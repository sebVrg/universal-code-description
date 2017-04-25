[![Codacy Badge](https://api.codacy.com/project/badge/Grade/0f8e153fc3254bf9a27d3276f1450c42)](https://www.codacy.com/app/seeren/universal-code-description?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=seeren/universal-code-description&amp;utm_campaign=Badge_Grade) [![Build Status](https://travis-ci.org/seeren/universal-code-description.svg?branch=master)](https://travis-ci.org/seeren/universal-code-description) [![GitHub license](https://img.shields.io/badge/license-MIT-orange.svg)](https://raw.githubusercontent.com/seeren/view/master/LICENSE) [![GitHub tag](https://img.shields.io/github/tag/seeren/universal-code-description.svg)](https://github.com/seeren/universal-code-description/releases)

# universal-code-description API
Propose an universal interface for code description.

## API Demo
Target a PHP or JS repository like  [seeren/universal-code-description](http://universal-code-description.alwaysdata.net/seeren/universal-code-description).
```
{
    "distribuable": false,
    "testable": true,
    "language": "php",
    "vendor": "seeren",
    "repository": "universal-code-description",
    "package": "seeren\/universal-code-description",
    "description": "An universal interface for code description",
    "keywords": [
        "api",
        "api-rest",
        "repository-description",
        "package-description"
    ],
    "type": "project",
    "homepage": "http:\/\/universal-code-description.alwaysdata.net\/seeren\/universal-code-description",
    "dependencies": [],
    "devDependencies": [
        "phpunit\/phpunit"
    ],
    "version": [],
    "license": "MIT",
    "author": "Cyril Ichti"
}
```
The API provide a short description per repository. Based on package.json or composer.json check if the code is available on nmp or packagist and travis. The hosted demo allow all origins.

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