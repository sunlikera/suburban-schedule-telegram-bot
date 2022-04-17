<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

//TODO: DI
$config = require __DIR__ . '/config/config.php';

use GuzzleHttp\Client;
use Api\Rasp\Repository\Schedule\ScheduleRepository;
use Api\Rasp\Repository\Search\SearchRepository;

//TODO: DI
$client = new Client(['base_uri' => 'https://api.rasp.yandex.net/v3.0/']);

//TODO: Controller
// $scheduleRepository = new ScheduleRepository($client, $config['api_key']);
// $schedule = $scheduleRepository->getSchedule('s9600681');

$searchRepository = new SearchRepository($client, $config['api_key']);
$searchResult = $searchRepository->getSearchResult('s9600681', 's2000002');

print_r($searchResult);