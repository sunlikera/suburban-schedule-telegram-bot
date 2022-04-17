<?php

declare(strict_types=1);

namespace Api\Rasp\Repository\Schedule\Schedule;

use Api\Rasp\Repository\Schedule\Schedule\DTO\Train;

class Schedule
{
    private $collection = [];

    /**
     * @param integer $id
     * @param Train $train
     * @return void
     */
    public function add(int $id, Train $train): void
    {
        $this->collection[$id] = $train;
    }

    /**
     * @param integer $id
     * @return void
     */
    public function remove(int $id): void
    {
        try {
            unset($this->collection[$id]);
        } catch (\Throwable $e) {
            //TODO: кидать исключение (возможно сделать свое, когда нет элемента в коллекции, и общее)
        }
    }
}