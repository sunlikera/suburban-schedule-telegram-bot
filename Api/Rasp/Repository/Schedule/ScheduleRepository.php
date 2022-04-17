<?php

declare (strict_types = 1);

namespace Api\Rasp\Repository\Schedule;

use Api\Rasp\Repository\Schedule\Schedule\Schedule;
use Api\Rasp\Repository\Schedule\Schedule\Factory;
use Api\Rasp\Repository\Schedule\Exception\EmptyScheduleResponseException;
use GuzzleHttp\Client;

class ScheduleRepository
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
     * @param string $direction
     * @return array
     */
    public function getSchedule(string $stationId, string $direction = 'на Москву'): Schedule
    {
        $response = $this->client->request('GET', 'schedule', [
            'query' => [
                'apikey' => $this->apiKey,
                'station' => $stationId,
                'transport_types' => 'suburban',
                'direction' => $direction,
            ]
        ]);

        //TODO: переделать на константы!
        if ($response->getStatusCode() !== 200) {
            //TODO: залогировать
            //TODO: кидать исключение
        }

        try {
            $rawData = $response->getBody()->getContents();
            $data = json_decode($rawData, true);

            if (empty($data['schedule'])) {
                //TODO: залогировать
                throw new EmptyScheduleResponseException();
            }

            return Factory::createCollection($data['schedule']);
        } catch (\Throwable $e) {
            throw $e;
        }
    }
}
