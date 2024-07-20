<?php

declare(strict_types=1);

namespace ASolonytkyi\Taapi\Containers\Taapi\Providers;

use Illuminate\Support\ServiceProvider;
use ASolonytkyi\Taapi\Containers\Taapi\Services\TaapiService;
use ASolonytkyi\Taapi\Containers\Taapi\Actions\GetIndicatorAction;

class TaapiServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(__DIR__ . '/../Config/taapi.php', 'taapi');

        $this->app->singleton(TaapiService::class, function ($app) {
            return new TaapiService(config('taapi.api_key'));
        });
    }

    public function boot(): void
    {
        $this->publishes([
            __DIR__ . '/../Config/taapi.php' => config_path('taapi.php'),
        ]);
    }
}
