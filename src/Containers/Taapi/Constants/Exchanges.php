<?php

declare(strict_types=1);

namespace ASolonytkyi\Taapi\Containers\Taapi\Constants;

class Exchanges
{
    public const STOCKS = 'stocks';
    public const BINANCE = 'binance';
    public const BINANCE_FUTURES = 'binancefutures';
    public const BITSTAMP = 'bitstamp';
    public const WHITEBIT = 'whitebit';
    public const BYBIT = 'bybit';
    public const GATEIO = 'gateio';
    public const COINBASE = 'coinbase';
    public const BINANCE_US = 'binanceus';
    public const KRAKEN = 'kraken';
    
    public const EXCHANGES = [
        self::STOCKS,
        self::BINANCE,
        self::BINANCE_FUTURES,
        self::BITSTAMP,
        self::WHITEBIT,
        self::BYBIT,
        self::GATEIO,
        self::COINBASE,
        self::BINANCE_US,
        self::KRAKEN,
    ];
}
