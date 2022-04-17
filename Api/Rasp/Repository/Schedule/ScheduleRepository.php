<?php

declare (strict_types = 1);

namespace Api\Rasp\Repository\Schedule;

use Api\Rasp\Repository\Schedule\Schedule\Schedule;
use Api\Rasp\Repository\Schedule\Schedule\DTO\Train;
use Api\Rasp\Repository\Schedule\Exception\EmptyArrivalDateExpception;
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
            //кидать исключение
        }

        try {
            $rawData = $response->getBody()->getContents();
            $data = json_decode($rawData, true);

            //TODO: обработка случая, когда пустой массив schedule

            return $this->hydrate($data['schedule']);
        } catch (\Throwable $e) {
            throw $e;
        }
    }

    /**
     * @param array $data
     * @return Schedule
     */
    private function hydrate(array $data): Schedule
    {
        $schedule = new Schedule();

        foreach ($data as $item) {
            if ($train = $this->getTrain($item)) {
                $schedule->add($train->getNumber(), $train);
            }
        }

        return $schedule;
    }

    /**
     * @param array $data
     * @return Train|null
     */
    private function getTrain(array $data): ?Train
    {
        try {
            if (empty($data['arrival'])) {
                throw new EmptyArrivalDateExpception();
            }

            return new Train(
                $data['arrival'],
                $data['departure'],
                (int)$data['thread']['number'],
                $data['thread']['title'],
                $data['thread']['short_title'],
                $data['direction'],
                $data['stops'],
                $data['platform'],
            );
        } catch (EmptyArrivalDateExpception $emptyArrival) {
            return null;
        } catch (\Throwable $e) {
            throw $e;
        }
    }
}
