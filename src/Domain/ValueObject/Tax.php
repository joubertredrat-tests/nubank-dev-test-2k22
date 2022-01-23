<?php

declare(strict_types=1);

namespace Nubank\DevTest\Domain\ValueObject;

class Tax
{
    private int $amount;

    public function __construct(int $amount)
    {
        $this->amount = $amount;
    }

    public function getAmount(): int
    {
        return $this->amount;
    }
}
