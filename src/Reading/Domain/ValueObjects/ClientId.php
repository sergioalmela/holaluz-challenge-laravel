<?php

namespace Src\Reading\Domain\ValueObjects;

use Src\Reading\Domain\Exceptions\IdNotFound;

final class ClientId
{
    private string $id;

    public function __construct(string $id)
    {
        $this->setId($id);
    }

    /**
     * @return string
     */
    public function value(): string
    {
        return $this->id;
    }

    /**
     * @param string|null $id
     */
    public function setId(?string $id): void
    {
        if (!$id) {
            throw new IdNotFound($id);
        }

        $this->id = $id;
    }

}
