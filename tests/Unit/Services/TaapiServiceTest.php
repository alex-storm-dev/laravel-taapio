<?php

declare(strict_types=1);

namespace ASolonytkyi\Taapi\Test\Unit\Services;

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Exception\RequestException;
use ASolonytkyi\Taapi\Containers\Taapi\Services\TaapiService;

class TaapiServiceTest extends TestCase
{
    private $clientMock;
    private $taapiService;

    protected function setUp(): void
    {
        $this->clientMock = $this->createMock(Client::class);
        $this->taapiService = new TaapiService('test_api_key', $this->clientMock); // Inject mock client
    }

    public function testRequest()
    {
        $responseBody = json_encode(['key' => 'value']);
        $response = new Response(200, [], $responseBody);

        $this->clientMock->method('get')
            ->willReturn($response);

        $result = $this->taapiService->request('test_endpoint', ['param' => 'value']);

        $this->assertEquals(['key' => 'value'], $result);
    }

    public function testBulkRequest()
    {
        $responseBody = json_encode(['key' => 'value']);
        $response = new Response(200, [], $responseBody);

        $this->clientMock->method('post')
            ->willReturn($response);

        $result = $this->taapiService->bulkRequest(['param' => 'value']);

        $this->assertEquals(['key' => 'value'], $result);
    }

    public function testRequestThrowsException()
    {
        $this->clientMock->method('get')
            ->willThrowException(new RequestException('Error', new \GuzzleHttp\Psr7\Request('GET', 'test')));

        $this->expectException(RequestException::class);

        $this->taapiService->request('test_endpoint', ['param' => 'value']);
    }

    public function testBulkRequestThrowsException()
    {
        $this->clientMock->method('post')
            ->willThrowException(new RequestException('Error', new \GuzzleHttp\Psr7\Request('POST', 'bulk')));

        $this->expectException(RequestException::class);

        $this->taapiService->bulkRequest(['param' => 'value']);
    }
}
