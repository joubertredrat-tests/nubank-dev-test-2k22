<?php

declare(strict_types=1);

namespace Nubank\DevTest\Application\UseCase;

use Nubank\DevTest\Domain\ValueObject\Operation;
use Nubank\DevTest\Domain\ValueObject\Tax;

class NubankTaxCalculator implements TaxCalculatorInterface
{
    private const TAX_PERCENT_DECIMAL = 0.2;
    private ProfitPriceCalculatorInterface $profitPriceCalculator;
    private int $lossAmount;

    public function __construct(ProfitPriceCalculatorInterface $profitPriceCalculator)
    {
        $this->profitPriceCalculator = $profitPriceCalculator;
        $this->lossAmount = 0;
    }

    public function getTax(Operation $operation): Tax
    {
        if ($operation->isTypeBuy()) {
            $this
                ->profitPriceCalculator
                ->addBuyOperation($operation)
            ;
            return new Tax(0);
        }

        if ($operation->isTaxExemption()) {
            return new Tax(0);
        }

        return $this->getTaxCalculated($operation);
    }

    private function getTaxCalculated(Operation $operation): Tax
    {
        $profitPrice = $this
            ->profitPriceCalculator
            ->getPrice()
        ;

        if ($profitPrice > $operation->getUnitCost()) {
            // add loss amount
            return new Tax(0);
        }

        $totalProfitPrice = $profitPrice * $operation->getQuantity();
        return new Tax(($operation->getTotal() - $totalProfitPrice) * self::TAX_PERCENT_DECIMAL);
    }
}
