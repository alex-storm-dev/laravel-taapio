<?php

declare(strict_types=1);

namespace ASolonytkyi\Taapi\Test\Unit\Actions;

use PHPUnit\Framework\TestCase;
use ASolonytkyi\Taapi\Containers\Taapi\Actions\GetIndicatorAction;
use ASolonytkyi\Taapi\Containers\Taapi\Services\TaapiService;
use ASolonytkyi\Taapi\Containers\Taapi\Validators\IndicatorValidator;
use ASolonytkyi\Taapi\Containers\Taapi\Resources\ApiResponse;
use ASolonytkyi\Taapi\Containers\Taapi\Handlers\ErrorHandler;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Request;

class GetIndicatorActionTest extends TestCase
{
    private $taapiServiceMock;
    private $getIndicatorAction;

    protected function setUp(): void
    {
        $this->taapiServiceMock = $this->createMock(TaapiService::class);
        $this->getIndicatorAction = new GetIndicatorAction($this->taapiServiceMock);
    }

    public function testRunSuccess()
    {
        $indicator = 'rsi';
        $params = [
            'exchange' => 'binance',
            'symbol' => 'BTC/USDT',
            'interval' => '1m',
            'period' => 14
        ];

        $responseData = ['key' => 'value'];

        $this->taapiServiceMock->method('request')
            ->willReturn($responseData);

        $result = $this->getIndicatorAction->run($indicator, $params);

        $this->assertEquals(ApiResponse::success($responseData), $result);
    }

    public function testRunRequestException()
    {
        $indicator = 'rsi';
        $params = [
            'exchange' => 'binance',
            'symbol' => 'BTC/USDT',
            'interval' => '1m',
            'period' => 14
        ];

        $exception = new RequestException('Error', new Request('GET', 'test'));

        $this->taapiServiceMock->method('request')
            ->willThrowException($exception);

        $result = $this->getIndicatorAction->run($indicator, $params);

        $expected = ErrorHandler::handle($exception);

        $this->assertEquals($expected, $result);
    }

    public function testRunInvalidArgumentException()
    {
        $indicator = 'invalid_indicator';
        $params = [
            'exchange' => 'binance',
            'symbol' => 'BTC/USDT',
            'interval' => '1m',
            'period' => 14
        ];

        $this->expectException(\InvalidArgumentException::class);

        IndicatorValidator::validate($indicator, $params);
    }
}
