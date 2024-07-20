<?php

declare(strict_types=1);

namespace ASolonytkyi\Taapi\Containers\Taapi\Constants;

class Intervals
{
    public const ONE_MINUTE = '1m';
    public const FIVE_MINUTES = '5m';
    public const FIFTEEN_MINUTES = '15m';
    public const THIRTY_MINUTES = '30m';
    public const ONE_HOUR = '1h';
    public const TWO_HOURS = '2h';
    public const FOUR_HOURS = '4h';
    public const TWELVE_HOURS = '12h';
    public const ONE_DAY = '1d';
    
    public const INTERVALS = [
        self::ONE_MINUTE,
        self::FIVE_MINUTES,
        self::FIFTEEN_MINUTES,
        self::THIRTY_MINUTES,
        self::ONE_HOUR,
        self::TWO_HOURS,
        self::FOUR_HOURS,
        self::TWELVE_HOURS,
        self::ONE_DAY,
    ];
}
