<?php

declare(strict_types=1);

namespace Nubank\DevTest\Domain\ValueObject;

class Tax
{
    private float $amount;

    public function __construct(float $amount)
    {
        $this->amount = $amount;
    }

    public function getAmount(): float
    {
        return $this->amount;
    }
}
