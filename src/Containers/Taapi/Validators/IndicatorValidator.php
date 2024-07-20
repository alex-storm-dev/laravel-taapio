<?php

declare(strict_types=1);

namespace ASolonytkyi\Taapi\Containers\Taapi\Validators;

use ASolonytkyi\Taapi\Containers\Taapi\Constants\Indicators;
use ASolonytkyi\Taapi\Containers\Taapi\Constants\Exchanges;
use ASolonytkyi\Taapi\Containers\Taapi\Constants\Intervals;

class IndicatorValidator
{
    private const REQUIRED_PARAMS = [
        'exchange' => Exchanges::EXCHANGES,
        'symbol' => 'string',
        'interval' => Intervals::INTERVALS,
    ];

    private const OPTIONAL_PARAMS = [
        'backtrack' => 'int',
        'chart' => 'string',
        'addResultTimestamp' => 'bool',
        'gaps' => 'bool',
        'results' => 'string',
        'period' => 'integer',
        'multiplier' => 'double',
    ];

    public static function validate(string $indicator, array $params): void
    {
        if (!in_array($indicator, Indicators::INDICATORS, true)) {
            throw new \InvalidArgumentException("Invalid indicator: $indicator");
        }

        foreach (self::REQUIRED_PARAMS as $param => $rule) {
            if (!isset($params[$param])) {
                throw new \InvalidArgumentException("'$param' is a required parameter!");
            }

            if (is_array($rule) && !in_array($params[$param], $rule, true)) {
                throw new \InvalidArgumentException("Invalid $param: {$params[$param]}");
            }
        }

        foreach (self::OPTIONAL_PARAMS as $param => $type) {
            if (isset($params[$param]) && gettype($params[$param]) !== $type) {
                throw new \InvalidArgumentException("Invalid $param: {$params[$param]} must be of type $type");
            }
        }
    }
}
