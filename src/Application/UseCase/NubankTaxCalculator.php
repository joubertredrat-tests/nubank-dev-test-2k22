<?php

declare(strict_types=1);

namespace Nubank\DevTest\Application\UseCase;

use Nubank\DevTest\Domain\ValueObject\Operation;
use Nubank\DevTest\Domain\ValueObject\Tax;

class NubankTaxCalculator implements TaxCalculatorInterface
{
    private const TAX_PERCENT_DECIMAL = 0.2;
    private ProfitPriceCalculatorInterface $profitPriceCalculator;
    private float $lossAmount;

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
            return $this->getTaxExemptionCalculated($operation);
        }

        return $this->getTaxCalculated($operation);
    }

    private function getTaxExemptionCalculated(Operation $operation): Tax
    {
        $profitPrice = $this
            ->profitPriceCalculator
            ->getPrice()
        ;

        if ($profitPrice > $operation->getUnitCost()) {
            $this->registerLossAmountOperation($operation);
        }

        return new Tax(0);
    }

    private function getTaxCalculated(Operation $operation): Tax
    {
        $profitPrice = $this
            ->profitPriceCalculator
            ->getPrice()
        ;

        if ($profitPrice > $operation->getUnitCost()) {
            $this->registerLossAmountOperation($operation);
            return new Tax(0);
        }

        $totalProfitPrice = $operation->getTotal() - ($profitPrice * $operation->getQuantity());
        if ($this->lossAmount > $totalProfitPrice) {
            $this->lossAmount -= $totalProfitPrice;
            return new Tax(0);
        }


        if ($this->lossAmount > 0) {
            $temp = $this->lossAmount;
            if ($this->lossAmount > $totalProfitPrice) {
                $this->lossAmount -= $totalProfitPrice;
                return new Tax(0);
            } else {
                $this->lossAmount = 0;
            }

            $totalProfitPrice -= $temp;
        }

        var_dump('$this->lossAmount ' . $this->lossAmount);
        var_dump('$totalProfitPrice ' . $totalProfitPrice);

        return new Tax($totalProfitPrice * self::TAX_PERCENT_DECIMAL);
    }

    private function registerLossAmountOperation(Operation $operation): void
    {
        $profitPrice = $this
            ->profitPriceCalculator
            ->getPrice()
        ;

        $operationProfitPrice = new Operation("sell", $profitPrice, $operation->getQuantity());
        $this->lossAmount += ($operationProfitPrice->getTotal() - $operation->getTotal());
    }
}
