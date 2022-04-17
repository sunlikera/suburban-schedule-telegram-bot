<?php

declare(strict_types=1);

namespace Api\Rasp\Repository\Schedule\Schedule;

use Api\Rasp\Repository\Schedule\Schedule\Schedule;
use Api\Rasp\Repository\Schedule\Schedule\DTO\Train;
use Api\Rasp\Repository\Schedule\Exception\EmptyArrivalDateExpception;

class Factory
{
    /**
     * @param array $data
     * @return Schedule
     */
    public static function createCollection(array $data): Schedule
    {
        $schedule = new Schedule();

        foreach ($data as $item) {
            if ($train = self::getTrain($item)) {
                $schedule->add($train->getNumber(), $train);
            }
        }

        return $schedule;
    }

    /**
     * @param array $data
     * @return Train|null
     */
    private static function getTrain(array $data): ?Train
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