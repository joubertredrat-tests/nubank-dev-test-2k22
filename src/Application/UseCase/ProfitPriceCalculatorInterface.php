<?php

declare(strict_types=1);

namespace Nubank\DevTest\Application\UseCase;

use Nubank\DevTest\Domain\ValueObject\Operation;

interface ProfitPriceCalculatorInterface
{
    public function addBuyOperation(Operation $operation): void;

    public function getPrice(): float;
}
