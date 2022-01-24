<?php

declare(strict_types=1);

namespace Nubank\DevTest\Application\UseCase;

use Nubank\DevTest\Domain\ValueObject\Operation;

class WeightedPriceCalculator implements ProfitPriceCalculatorInterface
{
    private float $totalPerOperation;
    private int $quantityPerOperation;

    public function __construct()
    {
        $this->totalPerOperation = 0;
        $this->quantityPerOperation = 0;
    }

    public function addBuyOperation(Operation $operation): void
    {
        if (!$operation->isTypeBuy()) {
            return;
        }

        $this->totalPerOperation += $operation->getTotal();
        $this->quantityPerOperation += $operation->getQuantity();
    }

    public function getPrice(): float
    {
        return $this->totalPerOperation / $this->quantityPerOperation;
    }
}
