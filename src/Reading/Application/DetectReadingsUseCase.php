<?php

namespace Src\Reading\Application;

final class DetectReadingsUseCase
{

    /**
     * Return those readings that are above or below the median.
     * @param array $readings
     * @param array $medians
     * @return array
     */
    public function execute(array $readings, array $medians): array
    {
        foreach ($readings as $key => $reading) {
            $clientId = $reading->id()->value();
            if (!($reading->getReading()->value() > ($medians[$clientId]->topValue()) || $reading->getReading()->value() < ($medians[$clientId]->bottomValue()))) {
                unset($readings[$key]);
            }
        }

        return $readings;
    }
}
