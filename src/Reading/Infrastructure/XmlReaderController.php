<?php

namespace Src\Reading\Infrastructure;

use Src\Reading\Domain\Contracts\ReaderRepository;
use Src\Reading\Domain\Entities\ReaderEntity;
use Src\Reading\Domain\ValueObjects\ClientId;
use Src\Reading\Domain\ValueObjects\Period;
use Src\Reading\Domain\ValueObjects\Reading;

final class XmlReaderController implements ReaderRepository
{
    public function read(string $path): array
    {
        $readings = [];

        $xmlFile = simplexml_load_file($path);

        foreach ($xmlFile as $data) {
            $reading = new ReaderEntity(
                new ClientId($data['clientID']),
                new Period($data['period']),
                new Reading((int)$data)
            );
            $readings[] = $reading;
        }

        return $readings;
    }
}
