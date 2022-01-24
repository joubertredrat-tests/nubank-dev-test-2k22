<?php

declare(strict_types=1);

namespace Nubank\DevTest\Application\UseCase;

use Nubank\DevTest\Domain\ValueObject\Operation;
use Nubank\DevTest\Domain\ValueObject\Tax;

interface TaxCalculatorInterface
{
    public function getTax(Operation $operation): Tax;
}
