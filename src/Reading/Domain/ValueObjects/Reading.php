<?php

namespace Src\Reading\Domain\ValueObjects;

final class Reading
{
    private int $reading;

    public function __construct(int $reading)
    {
        $this->setReading($reading);
    }

    /**
     * @return int
     */
    public function value(): int
    {
        return $this->reading;
    }

    /**
     * @param int $reading
     */
    public function setReading(int $reading): void
    {
        $this->reading = $reading;
    }


}
