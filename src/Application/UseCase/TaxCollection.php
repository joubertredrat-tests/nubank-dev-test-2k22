<?php

declare(strict_types=1);

namespace Nubank\DevTest\Application\UseCase;

use Nubank\DevTest\Domain\ValueObject\Tax;

class TaxCollection
{
    private array $collection;

    public function __construct()
    {
        $this->collection = [];
    }

    public function addTax(Tax $tax): void
    {
        $this->collection[] = $tax;
    }

    public function getCollection(): array
    {
        return $this->collection;
    }
}
