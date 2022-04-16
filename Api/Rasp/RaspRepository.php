<?php

declare (strict_types = 1);

namespace Api\Rasp;

use GuzzleHttp\Client;

class RaspRepository
{
    /**
     * @var Client
     */
    private $client;

    /**
     * @var string
     */
    private $apiKey;

    /**
     * @param Client $client
     * @param string $apiKey
     */
    public function __construct(Client $client, string $apiKey)
    {
        $this->client = $client;
        $this->apiKey = $apiKey;
    }

    /**
     * @param string $stationId
     * @return array
     */
    public function getSchedule(string $stationId): array
    {
        $response = $this->client->request('GET', 'schedule', [
            'query' => [
                'apikey' => $this->apiKey,
                'station' => $stationId,
            ]
        ]);

        //TODO: переделать на константы!
        if ($response->getStatusCode() !== 200) {
            //кидать исключение
        }

        try {
            return json_decode($response->getBody()->getContents(), true);
        } catch (\Throwable $e) {
            throw $e;
        }
    }
}
