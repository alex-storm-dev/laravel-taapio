<?php

declare(strict_types=1);

namespace ASolonytkyi\Taapi\Containers\Taapi\Facades;

use ASolonytkyi\Taapi\Containers\Taapi\Actions\GetIndicatorsAction;
use Illuminate\Support\Facades\Facade;
use ASolonytkyi\Taapi\Containers\Taapi\Actions\GetIndicatorAction;

class Taapi extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'taapi';
    }

    public static function getIndicator(string $indicator, array $params): array
    {
        return resolve(GetIndicatorAction::class)->run($indicator, $params);
    }

    public static function getIndicators(array $requests): array
    {
        return resolve(GetIndicatorsAction::class)->run($requests);
    }
}
