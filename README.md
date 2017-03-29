# Orange SDK

## Introduction

This SDK makes assists in integrating with Orange Business Rules, the system of record for many of the resources integral to Orange's applications.

## Setup
1. Add repository to project's `composer.json` file. (see below)
2. `composer require rethink-group/orange-sdk:dev-master`
3. `composer install`


### Adding the repository as a package source
```
"repositories" : [
    {
        "type" : "vcs",
        "url" : "https://gitlab.com/therethinkgroupinc/packages/orange-sdk",
        "options": {
            "ssh2": {
                "pubkey_file": "~/.ssh/id_rsa.pub",
                "privkey_file": "~/.ssh/id_rsa"
            }
        }
    }
],
```