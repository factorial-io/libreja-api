# libreja API

## Installation
As long as this project is not available at packagist.org, add this repo to your composer.json:

```json
{
  "repositories": [
    {
      "type": "vcs",
      "url": "git@github.com:factorial-io/libreja-api.git"
    }
  ]
}
```

Then require this project via composer as dev dependency:

```shell
composer require factorial-io/libreja-api:dev-main
```

This should download the project and install it into vendor.

## Usage
```php
use Factorial\Libreja\LibrejaClient;
use Factorial\Libreja\Environment\TestEnvironment;
// Creating an environment
$credentials = [
  'nick' => '<<NICK>>',
  'password' => '<<PASSWORD>>'
];

$environment = new TestEnvironment();
$client = new LibrejaClient($environment, $credentials);
```