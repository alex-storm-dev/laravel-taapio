
# Laravel TAAPI Package

A Laravel package to integrate with TAAPI.io for retrieving various financial indicators.

## Installation

1. Install the package via Composer:

    ```sh
    composer require asolonytkyi/laravel-taapi
    ```

2. Publish the configuration file:

    ```sh
    php artisan vendor:publish --provider="ASolonytkyi\Taapi\Containers\Taapi\Providers\TaapiServiceProvider"
    ```

3. Add your TAAPI.io API key to your `.env` file:

    ```env
    TAAPI_API_KEY=your_api_key_here
    ```

## Configuration

The package configuration file is located at `config/taapi.php`. You can customize the configuration as needed.

## Usage

### Retrieving a Single Indicator

To retrieve a single indicator, use the `getIndicator` method:

```php
use ASolonytkyi\Taapi\Containers\Taapi\Facades\Taapi;
use ASolonytkyi\Taapi\Containers\Taapi\Constants\Exchanges;
use ASolonytkyi\Taapi\Containers\Taapi\Constants\Intervals;
use ASolonytkyi\Taapi\Containers\Taapi\Constants\Indicators;

$data = Taapi::getIndicator(Indicators::ADX, [
    'exchange' => Exchanges::BINANCE,
    'symbol' => 'BTC/USDT',
    'interval' => Intervals::ONE_HOUR,
    'backtrack' => 5,
    'chart' => 'candlestick',
    'addResultTimestamp' => true,
    'gaps' => false,
    'results' => 'json',
    'period' => 14,
    'multiplier' => 1.5,
]);

print_r($data);
```

### Retrieving Multiple Indicators

To retrieve multiple indicators in a single request, use the `getIndicators` method:

```php
use ASolonytkyi\Taapi\Containers\Taapi\Facades\Taapi;
use ASolonytkyi\Taapi\Containers\Taapi\Constants\Exchanges;
use ASolonytkyi\Taapi\Containers\Taapi\Constants\Intervals;
use ASolonytkyi\Taapi\Containers\Taapi\Constants\Indicators;

$data = Taapi::getIndicators([
    'exchange' => Exchanges::BINANCE,
    'symbol' => 'BTC/USDT',
    'interval' => Intervals::ONE_MINUTE,
    'indicators' => [
        [
            'indicator' => Indicators::SUPER_TREND,
            'period' => 20,
            'multiplier' => 12.0,
        ],
        [
            'indicator' => Indicators::CMO,
            'period' => 20,
        ],
        [
            'indicator' => Indicators::RSI,
            'period' => 20,
        ],
        [
            'indicator' => Indicators::TANH,
            'period' => 20,
        ],
        [
            'indicator' => Indicators::EMA,
            'period' => 20,
        ],
        [
            'indicator' => Indicators::EOM,
            'period' => 20,
        ],
    ],
]);

print_r($data);
```

## Available Indicators

The following indicators are available for use:

- `Indicators::SUPER_TREND`
- `Indicators::CMO`
- `Indicators::RSI`
- `Indicators::TANH`
- `Indicators::EMA`
- `Indicators::EOM`
- `Indicators::ADX`
- [more](https://taapi.io/indicators/)

## Available Exchanges

The following [exchanges](https://taapi.io/exchanges/) are available for use:

- `Exchanges::BINANCE`
- `Exchanges::BINANCE_FUTURES`
- `Exchanges::BITSTAMP`
- `Exchanges::WHITEBIT`
- `Exchanges::BYBIT`
- `Exchanges::GATEIO`
- `Exchanges::COINBASE`
- `Exchanges::BINANCE_US`
- `Exchanges::KRAKEN`

## Available Intervals

The following [intervals](https://taapi.io/documentation/integration/direct/) are available for use:

- `Intervals::ONE_MINUTE`
- `Intervals::FIVE_MINUTES`
- `Intervals::FIFTEEN_MINUTES`
- `Intervals::THIRTY_MINUTES`
- `Intervals::ONE_HOUR`
- `Intervals::TWO_HOURS`
- `Intervals::FOUR_HOURS`
- `Intervals::TWELVE_HOURS`
- `Intervals::ONE_DAY`

## Error Handling

Errors are handled and returned as arrays with `status`, `message`, and `statusCode` keys. Example:

```php
$data = Taapi::getIndicator('invalid_indicator', [
    'exchange' => Exchanges::BINANCE,
    'symbol' => 'BTC/USDT',
    'interval' => Intervals::ONE_HOUR,
]);

if ($data['status'] === 'error') {
    echo 'Error: ' . $data['message'];
}
```

## License

This package is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).

## Author

- Alexandr Solonytskyi

For more information, visit the [TAAPI.io documentation](https://taapi.io/documentation/).