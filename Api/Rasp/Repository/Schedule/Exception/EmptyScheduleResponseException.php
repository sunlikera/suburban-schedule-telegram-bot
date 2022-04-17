<?php

declare(strict_types=1);

namespace Api\Rasp\Repository\Schedule\Exception;

use Exception;

class EmptyScheduleResponseException extends Exception
{
    protected $message = 'Пустой массив schedule в ответе к yandex rasp api';
}