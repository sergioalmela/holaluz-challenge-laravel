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
     * @param ClientId $id
     */
    public function setId(ClientId $id): void
    {
        $this->id = $id;
    }

    /**
     * @return Period
     */
    public function period(): Period
    {
        return $this->period;
    }

    /**
     * @param Period $period
     */
    public function setPeriod(Period $period): void
    {
        $this->period = $period;
    }

    /**
     * @return Reading
     */
    public function reading(): Reading
    {
        return $this->reading;
    }

    /**
     * @param Reading $reading
     */
    public function setReading(Reading $reading): void
    {
        $this->reading = $reading;
    }
}
