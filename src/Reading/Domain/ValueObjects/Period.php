<?php

namespace Src\Reading\Domain\ValueObjects;

final class Period
{
    private string $period;

    public function __construct(string $period)
    {
        $this->setPeriod($period);
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->period;
    }

    /**
     * @param string $period
     */
    public function setPeriod($period): void
    {
        $this->period = $period;
    }

}
