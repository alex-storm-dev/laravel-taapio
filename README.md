
# Laravel TAAPI.io Package

This package provides easy integration with the [TAAPI.io](https://taapi.io/) API for Laravel applications using Porto architecture.

## Table of Contents

- [Installation](#installation)
- [Configuration](#configuration)
- [Usage](#usage)
  - [Fetching a Single Indicator](#fetching-a-single-indicator)
  - [Fetching Multiple Indicators](#fetching-multiple-indicators)
- [Available Actions](#available-actions)
- [Testing](#testing)
- [Contributing](#contributing)
- [License](#license)
- [Author](#author)
- [Acknowledgements](#acknowledgements)
- [Changelog](#changelog)
- [Support](#support)

## Installation

### 1. Install the package via Composer:

Run the following command to install the package:

```sh
composer require asolonytskyi/laravel-taapi
```

### 2. Publish the configuration file:

Run the following command to publish the configuration file:

```sh
php artisan vendor:publish --provider="ASolonytkyi\Taapi\Containers\Taapi\Providers\TaapiServiceProvider"
```

### 3. Set your TAAPI API key in the `.env` file:

Add your TAAPI API key to the `.env` file:

```env
TAAPI_API_KEY=your-api-key
```

## Configuration

After publishing the configuration file, you can find it at `config/taapi.php`. This file contains the configuration options for the TAAPI service.

## Usage

You can use the `Taapi` facade to interact with the TAAPI.io API. Here are some examples:

### Fetching a Single Indicator

```php
use Taapi;

$data = Taapi::getIndicator('exampleIndicator', [
    'symbol' => 'BTC/USDT',
    'exchange' => 'binance'
]);
```

### Fetching Multiple Indicators

```php
use Taapi;

$indicators = Taapi::getIndicators([
    'symbol' => 'BTC/USDT',
    'exchange' => 'binance'
]);
```

## Available Actions

Currently, the package supports the following actions:

- `getIndicator`: Fetches data for a single indicator.
- `getIndicators`: Fetches data for multiple indicators.

### Adding New Actions

To extend the package with new actions:

1. Create a new action class in the `Actions` directory. For example, `GetAnotherIndicatorAction.php`.
2. Implement the logic for the new action.
3. Use the new action via the `Taapi` facade.

Example:

**New Action Class (`src/Containers/Taapi/Actions/GetAnotherIndicatorAction.php`):**
```php
<?php

declare(strict_types=1);

namespace ASolonytkyi\Taapi\Containers\Taapi\Actions;

use ASolonytkyi\Taapi\Containers\Taapi\Services\TaapiService;

class GetAnotherIndicatorAction
{
    protected TaapiService $taapiService;

    public function __construct(TaapiService $taapiService)
    {
        $this->taapiService = $taapiService;
    }

    public function run(array $params): array
    {
        return $this->taapiService->get('another-endpoint', $params);
    }
}
```

**Using the New Action:**
```php
use Taapi;

$data = Taapi::getAnotherIndicator([
    'symbol' => 'ETH/USD',
    'exchange' => 'coinbase'
]);
```

## Testing

To run the package tests, use the following command:

```sh
composer test
```

The tests are located in the `tests` directory and include basic tests to ensure the package is working correctly.

**Example Test (`tests/TaapiTest.php`):**
```php
<?php

declare(strict_types=1);

namespace ASolonytkyi\Taapi\Tests;

use Orchestra\Testbench\TestCase;
use ASolonytkyi\Taapi\Containers\Taapi\Providers\TaapiServiceProvider;
use ASolonytkyi\Taapi\Containers\Taapi\Actions\GetIndicatorAction;
use ASolonytkyi\Taapi\Containers\Taapi\Actions\GetIndicatorsAction;

class TaapiTest extends TestCase
{
    protected function getPackageProviders($app): array
    {
        return [TaapiServiceProvider::class];
    }

    protected function getPackageAliases($app): array
    {
        return [
            'Taapi' => Taapi::class,
        ];
    }

    /** @test */
    public function it_can_get_indicator_data(): void
    {
        $action = $this->app->make(GetIndicatorAction::class);
        $data = $action->run('exampleIndicator', [
            'symbol' => 'BTC/USDT',
            'exchange' => 'binance'
        ]);

        $this->assertIsArray($data);
    }

    /** @test */
    public function it_can_get_indicators_data(): void
    {
        $action = $this->app->make(GetIndicatorsAction::class);
        $data = $action->run([
            'symbol' => 'BTC/USDT',
            'exchange' => 'binance'
        ]);

        $this->assertIsArray($data);
    }
}
```

## Contributing

Contributions are welcome! If you would like to contribute to this package, please follow these steps:

1. Fork the repository.
2. Create a new branch (`git checkout -b feature/your-feature`).
3. Commit your changes (`git commit -m 'Add some feature'`).
4. Push to the branch (`git push origin feature/your-feature`).
5. Open a pull request.

Please make sure to write tests for any new features or changes, and ensure all existing tests pass.

## License

This package is open-source software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Author

This package was developed by [Andrii Solonytskyi](https://github.com/asolonytskyi).

## Acknowledgements

Special thanks to the contributors of the Laravel and TAAPI.io projects for their incredible work and support.

## Changelog

All notable changes to this project will be documented in this section.

### [1.0.0] - 2024-07-20
- Initial release

## Support

If you encounter any issues or have any questions, feel free to open an issue on the [GitHub repository](https://github.com/asolonytskyi/laravel-taapi).

Thank you for using the Laravel TAAPI.io package!
