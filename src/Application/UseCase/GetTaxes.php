<?php

declare(strict_types=1);

namespace Nubank\DevTest\Application\UseCase;

use Nubank\DevTest\Domain\ValueObject\Operation;
use Nubank\DevTest\Domain\ValueObject\Tax;

class GetTaxes
{
    public function execute(OperationCollection $operationCollection): TaxCollection
    {
        $taxCollection = new TaxCollection();

        /** @var Operation $operation */
        foreach ($operationCollection->getCollection() as $operation) {
            if ($operation->isTypeBuy()) {
                $taxCollection->addTax(new Tax(0));
                continue;
            }

            if ($operation->isTypeSell() && $operation->getTotal() <= 20000) {
                $taxCollection->addTax(new Tax(0));
                continue;
            }
        }

        return $taxCollection;
    }
}
