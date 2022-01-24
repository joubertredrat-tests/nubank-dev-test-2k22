<?php

declare(strict_types=1);

namespace Nubank\DevTest\Application\UseCase;

use Nubank\DevTest\Domain\ValueObject\Operation;

class GetTaxes
{
    private TaxCalculatorInterface $taxCalculator;

    public function __construct(TaxCalculatorInterface $taxCalculator)
    {
        $this->taxCalculator = $taxCalculator;
    }

    public function execute(OperationCollection $operationCollection): TaxCollection
    {
        $taxCollection = new TaxCollection();

        /** @var Operation $operation */
        foreach ($operationCollection->getCollection() as $operation) {
            $tax = $this
                ->taxCalculator
                ->getTax($operation)
            ;

            $taxCollection->addTax($tax);
        }

        return $taxCollection;
    }
}
