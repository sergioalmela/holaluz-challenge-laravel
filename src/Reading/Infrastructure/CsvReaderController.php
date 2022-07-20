<?php

namespace Src\Reading\Infrastructure;

use Src\Reading\Domain\Contracts\ReaderRepository;
use Src\Reading\Domain\Entities\ReaderEntity;
use Src\Reading\Domain\ValueObjects\ClientId;
use Src\Reading\Domain\ValueObjects\Period;
use Src\Reading\Domain\ValueObjects\Reading;

final class CsvReaderController implements ReaderRepository
{
    public function read(string $path): array
    {
        $readings = [];

        if (($open = fopen($path, "r")) !== FALSE) {
            fgetcsv($open, 1000, ",");

            while (($data = fgetcsv($open, 1000, ",", "'")) !== FALSE) {
                $reading = new ReaderEntity(
                    new ClientId($data[0]),
                    new Period($data[1]),
                    new Reading((int) $data[2])
                );
                $readings[] = $reading;
            }

            fclose($open);
        }

        return $readings;
    }
}
