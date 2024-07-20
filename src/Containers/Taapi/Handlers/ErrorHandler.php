<?php

declare(strict_types=1);

namespace ASolonytkyi\Taapi\Containers\Taapi\Handlers;

use GuzzleHttp\Exception\RequestException;

class ErrorHandler
{
    public static function handle(RequestException $e): array
    {
        return [
            'status' => 'error',
            'message' => $e->getMessage(),
            'statusCode' => $e->getResponse() ? $e->getResponse()->getStatusCode() : 500
        ];
    }
}
