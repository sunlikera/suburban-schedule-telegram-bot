<?php

declare(strict_types=1);

namespace Api\Rasp\Repository\Schedule\Exception;

use Exception;

class EmptyArrivalDateExpception extends Exception
{
    protected $message = 'Пустое поле arrival';
}