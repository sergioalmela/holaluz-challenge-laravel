<?php

namespace Src\Reading\Domain\ValueObjects;

final class Median
{
    private int $median;
    private float $INCREMENT = 1.50;
    private float $DECREMENT = 0.50;

    public function topValue()
    {
        return $this->median * $this->INCREMENT;
    }

    public function bottomValue()
    {
        return $this->median * $this->DECREMENT;
    }

    /**
     * @return int
     */
    public function median(): int
    {
        return $this->median;
    }

    /**
     * @param int $median
     */
    public function setMedian(int $median): void
    {
        $this->median = $median;
    }

}
