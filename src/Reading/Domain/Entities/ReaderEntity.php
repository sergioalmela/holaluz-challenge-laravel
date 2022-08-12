<?php

namespace Src\Reading\Domain\Entities;

use Src\Reading\Domain\ValueObjects\ClientId;
use Src\Reading\Domain\ValueObjects\Period;
use Src\Reading\Domain\ValueObjects\Reading;

final class ReaderEntity
{
    private ClientId $id;
    private Period $period;
    private Reading $reading;

    public function __construct(ClientId $id, Period $period, Reading $reading)
    {
        $this->id = $id;
        $this->period = $period;
        $this->reading = $reading;
    }

    /**
     * @return ClientId
     */
    public function id(): ClientId
    {
        return $this->id;
    }

    /**
     * @return ClientId
     */
    public function getId(): ClientId
    {
        return $this->id;
    }

    /**
     * @return Period
     */
    public function period(): Period
    {
        return $this->period;
    }

    /**
     * @return Period
     */
    public function getPeriod(): Period
    {
        return $this->period;
    }

    /**
     * @return Reading
     */
    public function reading(): Reading
    {
        return $this->reading;
    }

    /**
     * @return Reading
     */
    public function getReading(): Reading
    {
        return $this->reading;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'period' => $this->getPeriod(),
            'reading' => $this->getReading()
        ];
    }
}
