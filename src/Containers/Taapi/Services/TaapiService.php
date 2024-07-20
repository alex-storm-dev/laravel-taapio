<?php

declare(strict_types=1);

namespace ASolonytkyi\Taapi\Containers\Taapi\Services;

use GuzzleHttp\Client;

class TaapiService
{
    private string $apiKey;
    private Client $client;
    private const string BASE_URI = 'https://api.taapi.io/';

    public function __construct(string $apiKey)
    {
        $this->apiKey = $apiKey;
        $this->client = new Client(['base_uri' => self::BASE_URI]);
    }

    public function get(string $endpoint, array $params): array
    {
        $response = $this->client->get($endpoint, [
            'query' => array_merge($params, ['secret' => $this->apiKey])
        ]);

        return json_decode($response->getBody()->getContents(), true);
    }
}
