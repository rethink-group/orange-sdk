# Orange SDK

## Introduction

This SDK makes assists in integrating with Orange Business Rules, the system of record for many of the resources integral to Orange's applications.

## Setup
1. Add repository to project's `composer.json` file. (see below)
2. `composer require rethink-group/orange-sdk:dev-master`
3. `composer install`

### Adding the repository as a package source
```json
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

## Usage
1. Add the following to your `.env` and `.env.example` files, filling in the appropriate values in `.env`:

```
OBR_URL=http://orange_business_rules.dev/api/v1
OBR_ID=TESTAPP
OBR_SECRET=test123
```

2. In a Laravel application, add the following to your `config/service.php` file:

```php
'obr' => [
    'url'  => env('OBR_URL'),
    'clientId'    => env('OBR_ID'),
    'clientSecret' => env('OBR_SECRET'),
],
```

## Testing

Take note that the tests in this package are very fragile because they depend upon certain data being present in a local installation of OBR. This could be solved by implementing mocking, and should be done as soon as possible.