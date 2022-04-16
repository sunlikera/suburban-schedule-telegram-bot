<?php

declare(strict_types=1);

require __DIR__ . '/vendor/autoload.php';

//TODO: DI
$config = require __DIR__ . '/config/config.php';

use GuzzleHttp\Client;
use Api\Rasp\RaspRepository;

//TODO: DI
$client = new Client(['base_uri' => 'https://api.rasp.yandex.net/v3.0/']);

//TODO: Controller
$repository = new RaspRepository($client, $config['api_key']);

$schedule = $repository->getSchedule('s9600681');

print_r($schedule);