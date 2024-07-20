<?php

declare(strict_types=1);

namespace ASolonytkyi\Taapi\Containers\Taapi\Resources;

final class ApiResponse
{
    public static function success(array $data): array
    {
        return [
            'status' => 'success',
            'data' => $data
        ];
    }

    public static function error(string $message, int $statusCode): array
    {
        return [
            'status' => 'error',
            'message' => $message,
            'statusCode' => $statusCode
        ];
    }
}
