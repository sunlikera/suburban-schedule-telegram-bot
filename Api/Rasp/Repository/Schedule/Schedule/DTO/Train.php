<?php

declare(strict_types=1);

namespace Api\Rasp\Repository\Schedule\Schedule\DTO;

class Train
{
    /**
     * @var string
     */
    private $arrival;

    /**
     * @var string
     */
    private $departure;

    /**
     * @var int
     */
    private $number;

    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $shortTitle;

    /**
     * @var string
     */
    private $direction;

    /**
     * @var string
     */
    private $stops;

    /**
     * @var string
     */
    private $platform;

    /**
     * @param DateTime $arrival
     * @param DateTime $departure
     * @param integer $number
     * @param string $title
     * @param string $shortTitle
     * @param string $direction
     * @param string $stops
     * @param string $platform
     */
    public function __construct(
        string $arrival,
        string $departure,
        int $number,
        string $title,
        string $shortTitle,
        string $direction,
        string $stops,
        string $platform
    ) {
        $this->arrival = $arrival;
        $this->departure = $departure;
        $this->number = $number;
        $this->title = $title;
        $this->shortTitle = $shortTitle;
        $this->direction = $direction;
        $this->stops = $stops;
        $this->platform = $platform;
    }

    /**
     * 
     * @return string
     */
    public function getArrival(): string
    {
        return $this->arrival;
    }

    /**
     * 
     * @return string
     */
    public function getDeparture(): string
    {
        return $this->departure;
    }

    /**
     * @return integer
     */
    public function getNumber(): int
    {
        return $this->number;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getShortTitle(): string
    {
        return $this->shortTitle;
    }

    /**
     * @return string
     */
    public function getDirection(): string
    {
        return $this->direction;
    }

    /**
     * @return string
     */
    public function getStops(): string
    {
        return $this->stops;
    }

    /**
     * @return string
     */
    public function getPlatform(): string
    {
        return $this->platform;
    }
}