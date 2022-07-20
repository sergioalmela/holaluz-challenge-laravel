<?php

namespace Src\Reading\Application;

use Src\Reading\Domain\Contracts\ReaderRepository;

final class ReadFileUseCase
{
    private ReaderRepository $readerRepository;

    public function __construct(ReaderRepository $readerRepository)
    {
        $this->readerRepository = $readerRepository;
    }

    public function execute(string $path)
    {
        return $this->readerRepository->read($path);
    }
}
