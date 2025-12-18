# DataRequestApi

Simple class for making requests to the O6 Web Properties Data Request API.

## Usage

```php
use o6web\DataRequestApi\DataRequestApi;

$dataRequestApi = new DataRequesApi($root_url, $token);

$dataRequestApi->request('GET', 'request/path', ['arg' => 'value']);
```

## Installation

Simply add a dependency on o6web/data-request-api to your composer.json file if you use [Composer](https://getcomposer.org/) to manage the dependencies of your project:

```sh
composer require o6web/data-request-api
```

Although it's recommended to use Composer, you can actually include the file(s) any way you want.


## License

DataRequestApi is [MIT](http://opensource.org/licenses/MIT) licensed.