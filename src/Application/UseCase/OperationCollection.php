<?php

declare(strict_types=1);

namespace Nubank\DevTest\Application\UseCase;

use Nubank\DevTest\Domain\ValueObject\Operation;

class OperationCollection
{
    private array $collection;

    public function __construct()
    {
        $this->collection = [];
    }

    public function addOperation(Operation $operation): void
    {
        $this->collection[] = $operation;
    }

    public function getCollection(): array
    {
        return $this->collection;
    }
}
