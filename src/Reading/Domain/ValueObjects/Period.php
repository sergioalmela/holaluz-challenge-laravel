<?php

namespace Src\Reading\Domain\ValueObjects;

use Carbon\Carbon;

final class Period
{
    private string $period;

    public function __construct(string $period)
    {
        $this->period = $period;
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->period;
    }

    /**
     * @return String
     */
    public function month(): string
    {
        return Carbon::parse($this->period)->format('M');
    }

    /**
     * @param string $period
     */
    public function setPeriod(string $period): void
    {
        $this->period = $period;
    }

}
