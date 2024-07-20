<?php

declare(strict_types=1);

namespace ASolonytkyi\Taapi\Containers\Taapi\Actions;

use ASolonytkyi\Taapi\Containers\Taapi\Services\TaapiService;
use ASolonytkyi\Taapi\Containers\Taapi\Validators\IndicatorValidator;
use ASolonytkyi\Taapi\Containers\Taapi\Handlers\ErrorHandler;
use ASolonytkyi\Taapi\Containers\Taapi\Resources\ApiResponse;
use GuzzleHttp\Exception\RequestException;

class GetIndicatorsAction
{
    private TaapiService $taapiService;

    public function __construct(TaapiService $taapiService)
    {
        $this->taapiService = $taapiService;
    }

    public function run(array $params): array
    {
        $requiredParams = ['exchange', 'symbol', 'interval', 'indicators'];
        foreach ($requiredParams as $param) {
            if (!isset($params[$param])) {
                return ApiResponse::error("'$param' is a required parameter!", 400);
            }
        }

        $validatedIndicators = [];
        foreach ($params['indicators'] as $indicatorParams) {
            $indicator = $indicatorParams['indicator'];
            $indicatorSpecificParams = array_diff_key($indicatorParams, ['indicator' => '']);

            try {
                IndicatorValidator::validate($indicator, array_merge($params, $indicatorSpecificParams));
                $validatedIndicators[] = array_merge(['indicator' => $indicator], $indicatorSpecificParams);
            } catch (\InvalidArgumentException $e) {
                return ApiResponse::error($e->getMessage(), 400);
            }
        }

        $requestPayload = [
            'construct' => [
                'exchange' => $params['exchange'],
                'symbol' => $params['symbol'],
                'interval' => $params['interval'],
                'indicators' => $validatedIndicators,
            ],
        ];

        try {
            $data = $this->taapiService->bulkRequest($requestPayload);
            return ApiResponse::success($data['data']);
        } catch (RequestException $e) {
            return ErrorHandler::handle($e);
        }
    }
}
