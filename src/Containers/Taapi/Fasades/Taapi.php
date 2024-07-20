<?php

declare(strict_types=1);

namespace ASolonytkyi\Taapi\Containers\Taapi\Facades;

use Illuminate\Support\Facades\Facade;

class Taapi extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \ASolonytkyi\Taapi\Containers\Taapi\Services\TaapiService::class;
    }
}
