<?php

declare(strict_types=1);

namespace ASolonytkyi\Taapi\Containers\Taapi\Actions;

use ASolonytkyi\Taapi\Containers\Taapi\Handlers\ErrorHandler;
use ASolonytkyi\Taapi\Containers\Taapi\Resources\ApiResponse;
use ASolonytkyi\Taapi\Containers\Taapi\Services\TaapiService;
use ASolonytkyi\Taapi\Containers\Taapi\Validators\IndicatorValidator;
use GuzzleHttp\Exception\RequestException;

class GetIndicatorAction
{
    private TaapiService $taapiService;

    public function __construct(TaapiService $taapiService)
    {
        $this->taapiService = $taapiService;
    }

    public function run(string $indicator, array $params): array
    {
        try {
            IndicatorValidator::validate($indicator, $params);

            $data = $this->taapiService->request($indicator, $params);

            return ApiResponse::success($data);
        } catch (RequestException $e) {
            return ErrorHandler::handle($e);
        } catch (\InvalidArgumentException $e) {
            return ApiResponse::error($e->getMessage(), 400);
        }
    }
}
