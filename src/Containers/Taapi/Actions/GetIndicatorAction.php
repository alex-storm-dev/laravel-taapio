<?php

declare(strict_types=1);

namespace ASolonytkyi\Taapi\Containers\Taapi\Actions;

use ASolonytkyi\Taapi\Containers\Taapi\Services\TaapiService;

class GetIndicatorAction
{
    private TaapiService $taapiService;

    public function __construct(TaapiService $taapiService)
    {
        $this->taapiService = $taapiService;
    }

    public function run(string $indicator, array $params): array
    {
        return $this->taapiService->get($indicator, $params);
    }
}
