<?php

declare(strict_types=1);

namespace ASolonytkyi\Taapi\Test\Unit\Actions;

use PHPUnit\Framework\TestCase;
use ASolonytkyi\Taapi\Containers\Taapi\Actions\GetIndicatorsAction;
use ASolonytkyi\Taapi\Containers\Taapi\Services\TaapiService;
use ASolonytkyi\Taapi\Containers\Taapi\Validators\IndicatorValidator;
use ASolonytkyi\Taapi\Containers\Taapi\Resources\ApiResponse;
use ASolonytkyi\Taapi\Containers\Taapi\Handlers\ErrorHandler;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;

class GetIndicatorsActionTest extends TestCase
{
    private $taapiServiceMock;
    private $getIndicatorsAction;

    protected function setUp(): void
    {
        $this->taapiServiceMock = $this->createMock(TaapiService::class);
        $this->getIndicatorsAction = new GetIndicatorsAction($this->taapiServiceMock);
    }

    public function testRunSuccess()
    {
        $params = [
            'exchange' => 'binance',
            'symbol' => 'BTC/USDT',
            'interval' => '1m',
            'indicators' => [
                [
                    'indicator' => 'rsi',
                    'period' => 14
                ],
                [
                    'indicator' => 'cmo',
                    'period' => 20
                ]
            ]
        ];

        $responseData = ['data' => [['key' => 'value']]];

        $this->taapiServiceMock->method('bulkRequest')
            ->willReturn($responseData);

        $result = $this->getIndicatorsAction->run($params);

        $this->assertEquals(ApiResponse::success($responseData['data']), $result);
    }

    public function testRunRequestException()
    {
        $params = [
            'exchange' => 'binance',
            'symbol' => 'BTC/USDT',
            'interval' => '1m',
            'indicators' => [
                [
                    'indicator' => 'rsi',
                    'period' => 14
                ]
            ]
        ];

        $exception = new RequestException('Error', new Request('POST', 'bulk'));

        $this->taapiServiceMock->method('bulkRequest')
            ->willThrowException($exception);

        $result = $this->getIndicatorsAction->run($params);

        $expected = ErrorHandler::handle($exception);

        $this->assertEquals($expected, $result);
    }

    public function testRunInvalidArgumentException()
    {
        $params = [
            'exchange' => 'binance',
            'symbol' => 'BTC/USDT',
            'interval' => '1m',
            'indicators' => [
                [
                    'indicator' => 'invalid_indicator',
                    'period' => 14
                ]
            ]
        ];

        $this->expectException(\InvalidArgumentException::class);

        IndicatorValidator::validate('invalid_indicator', $params);
    }
}
