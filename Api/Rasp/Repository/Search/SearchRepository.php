<?php

declare(strict_types=1);

namespace Api\Rasp\Repository\Search;

use GuzzleHttp\Client;

class SearchRepository
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

    public function getSearchResult(string $departureStation, string $arrivalStation)
    {
        $response = $this->client->request('GET', 'search', [
            'query' => [
                'apikey' => $this->apiKey,
                'from' => $departureStation,
                'to' => $arrivalStation,
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

            print_r($data);
            die;

            // if (empty($data['schedule'])) {
            //     //TODO: залогировать
            // }

            // return Factory::createCollection($data['schedule']);
        } catch (\Throwable $e) {
            throw $e;
        }
    }
}