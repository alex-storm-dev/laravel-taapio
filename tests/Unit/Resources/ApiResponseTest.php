<?php

declare(strict_types=1);

namespace ASolonytkyi\Taapi\Test\Unit\Resources;

use PHPUnit\Framework\TestCase;
use ASolonytkyi\Taapi\Containers\Taapi\Resources\ApiResponse;

class ApiResponseTest extends TestCase
{
    public function testSuccess()
    {
        $data = ['key' => 'value'];
        $expected = [
            'status' => 'success',
            'data' => $data
        ];

        $result = ApiResponse::success($data);

        $this->assertEquals($expected, $result);
    }

    public function testError()
    {
        $message = 'An error occurred';
        $statusCode = 400;
        $expected = [
            'status' => 'error',
            'message' => $message,
            'statusCode' => $statusCode
        ];

        $result = ApiResponse::error($message, $statusCode);

        $this->assertEquals($expected, $result);
    }
}
