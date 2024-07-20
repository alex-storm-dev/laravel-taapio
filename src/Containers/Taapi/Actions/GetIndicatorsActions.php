<?php

declare(strict_types=1);

namespace ASolonytkyi\Taapi\Containers\Taapi\Actions;

use ASolonytkyi\Taapi\Containers\Taapi\Services\TaapiService;

class GetIndicatorsAction
{
    private TaapiService $taapiService;

    public function __construct(TaapiService $taapiService)
    {
        $this->taapiService = $taapiService;
    }

    public function run(array $params): array
    {
        return $this->taapiService->get('indicators', $params);
    }
}
