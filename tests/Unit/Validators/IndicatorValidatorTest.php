<?php

declare(strict_types=1);

namespace ASolonytkyi\Taapi\Test\Unit\Validators;

use PHPUnit\Framework\TestCase;
use ASolonytkyi\Taapi\Containers\Taapi\Validators\IndicatorValidator;
use ASolonytkyi\Taapi\Containers\Taapi\Constants\Indicators;
use ASolonytkyi\Taapi\Containers\Taapi\Constants\Exchanges;
use ASolonytkyi\Taapi\Containers\Taapi\Constants\Intervals;

class IndicatorValidatorTest extends TestCase
{
    public function testValidIndicatorAndParams()
    {
        $this->expectNotToPerformAssertions();

        IndicatorValidator::validate(Indicators::RSI, [
            'exchange' => Exchanges::BINANCE,
            'symbol' => 'BTC/USDT',
            'interval' => Intervals::ONE_MINUTE,
            'period' => 14
        ]);
    }

    public function testInvalidIndicator()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid indicator: invalid_indicator");

        IndicatorValidator::validate('invalid_indicator', [
            'exchange' => Exchanges::BINANCE,
            'symbol' => 'BTC/USDT',
            'interval' => Intervals::ONE_MINUTE,
        ]);
    }

    public function testMissingRequiredParam()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("'symbol' is a required parameter!");

        IndicatorValidator::validate(Indicators::RSI, [
            'exchange' => Exchanges::BINANCE,
            'interval' => Intervals::ONE_MINUTE,
        ]);
    }

    public function testInvalidRequiredParam()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid exchange: invalid_exchange");

        IndicatorValidator::validate(Indicators::RSI, [
            'exchange' => 'invalid_exchange',
            'symbol' => 'BTC/USDT',
            'interval' => Intervals::ONE_MINUTE,
        ]);
    }

    public function testInvalidOptionalParamType()
    {
        $this->expectException(\InvalidArgumentException::class);
        $this->expectExceptionMessage("Invalid period: fourteen must be of type integer");

        IndicatorValidator::validate(Indicators::RSI, [
            'exchange' => Exchanges::BINANCE,
            'symbol' => 'BTC/USDT',
            'interval' => Intervals::ONE_MINUTE,
            'period' => 'fourteen',
        ]);
    }
}
