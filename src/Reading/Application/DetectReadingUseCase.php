<?php

namespace Src\Reading\Application;

final class DetectReadingUseCase
{
    public function execute(array $readings, array $medians): array
    {
        foreach ($readings as $key => $reading) {
            $clientId = $reading->id()->value();
            $median = $medians[$clientId];

            if (($reading->reading()->value()) > $median->topValue() || ($reading->reading()->value()) < $median->bottomValue()) {
                unset($readings[$key]);
            }
        }

        return $readings;
    }
}
