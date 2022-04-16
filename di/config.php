<?php

use GuzzleHttp\Client;
use DI;

return [
    'HttpClient' => DI\create()
        ->constructor(DI\get('Webservice')),
];