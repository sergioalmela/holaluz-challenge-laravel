<?php

namespace Src\Reading\Domain\ValueObjects;

use Src\Reading\Domain\Exceptions\IncorrectReading;

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
        if ($reading >= 0) {
            $this->reading = $reading;
            return;
        }

        throw new IncorrectReading("Reading value should be positive, $reading is not positive");
    }

}
