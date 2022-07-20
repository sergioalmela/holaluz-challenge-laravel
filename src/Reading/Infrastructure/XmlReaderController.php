<?php

namespace Src\Reading\Infrastructure;

use Dotenv\Repository\Adapter\ReaderInterface;

final class XmlReaderController implements ReaderInterface
{
    public function read(string $path): array
    {
        $readings = [];

        if (($open = fopen(storage_path() . $path, "r")) !== FALSE) {

            while (($data = fgetcsv($open, 1000, ",", "'")) !== FALSE) {

                $readings[] = $data;
            }

            fclose($open);
        }

        return $readings;
    }
}
