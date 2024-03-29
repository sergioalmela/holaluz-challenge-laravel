<?php

namespace Src\Reading\Application;

use Src\Reading\Domain\ValueObjects\Median;

final class GetMedianUseCase
{

    /**
     * Return an array of median values for each reading
     * @param array $readings
     * @return array
     */
    public function execute(array $readings): array
    {
        $reading_values = [];

        foreach ($readings as $reading) {
            $reading_values[$reading->id()->value()][] = $reading->reading()->value();
        }

        $medians = [];

        foreach ($reading_values as $clientId => $reading) {
            sort($reading);

            $median = new Median();
            $count_values = count($reading);
            $middleval = floor(($count_values - 1) / 2);

            if ($count_values % 2) {
                $median_value = $reading[$middleval];
            } else {
                $low = $reading[$middleval];
                $high = $reading[$middleval + 1];
                $median_value = (($low + $high) / 2);
            }

            $median->setMedian($median_value);

            $medians[$clientId] = $median;
        }

        return $medians;
    }
}
