<?php

namespace Src\Reading\Domain\ValueObjects;

use Src\Reading\Domain\Exceptions\IncorrectMedian;

final class Median
{
    private int $median;

    // Add 50% to the median to get the upper limit.
    public function topValue(): int
    {
        return $this->median * 1.50;
    }

    // Subtract 50% to the median to get the lower limit.
    public function bottomValue(): int
    {
        return $this->median * 0.50;
    }

    /**
     * @return int
     */
    public function value(): int
    {
        return $this->median;
    }

    /**
     * @param int $median
     */
    public function setMedian(int $median): void
    {
        if ($median >= 0) {
            $this->median = $median;
            return;
        }

        throw new IncorrectMedian("Median value should be positive, $median is not positive");
    }

}
