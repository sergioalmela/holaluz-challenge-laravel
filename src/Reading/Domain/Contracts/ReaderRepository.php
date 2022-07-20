<?php

namespace Src\Reading\Domain\Contracts;

interface ReaderRepository
{
    public function read(string $path): array;
}
