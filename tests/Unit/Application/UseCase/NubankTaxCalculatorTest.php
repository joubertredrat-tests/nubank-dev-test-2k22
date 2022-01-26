<?php

declare(strict_types=1);

namespace Nubank\DevTest\Tests\Unit\Application\UseCase;

use Nubank\DevTest\Application\UseCase\NubankTaxCalculator;
use Nubank\DevTest\Application\UseCase\WeightedProfitPriceCalculator;
use Nubank\DevTest\Domain\ValueObject\Operation;
use Nubank\DevTest\Domain\ValueObject\Tax;
use PHPUnit\Framework\TestCase;

class NubankTaxCalculatorTest extends TestCase
{
    public function testGetTaxFromBuyOperation(): void
    {
        $taxExpected = new Tax(0);

        $nubankTaxCalculator = new NubankTaxCalculator(
            new WeightedProfitPriceCalculator()
        );
        $taxGot = $nubankTaxCalculator->getTax(
            new Operation('buy', 10, 10_000)
        );

        self::assertEquals($taxExpected, $taxGot);
    }

    public function testGetTaxFromSellOperationWithTaxExemption(): void
    {
        $taxExpected = new Tax(0);

        $nubankTaxCalculator = new NubankTaxCalculator(
            new WeightedProfitPriceCalculator()
        );
        $nubankTaxCalculator->getTax(
            new Operation('buy', 10, 10_000)
        );
        $taxGot = $nubankTaxCalculator->getTax(
            new Operation('sell', 15, 1_000)
        );

        self::assertEquals($taxExpected, $taxGot);
    }

    public function testGetTaxFromSellOperationWithTaxExemptionAndLossAmount(): void
    {
        $taxExpected = new Tax(0);

        $nubankTaxCalculator = new NubankTaxCalculator(
            new WeightedProfitPriceCalculator()
        );
        $nubankTaxCalculator->getTax(
            new Operation('buy', 10, 10_000)
        );
        $taxGot = $nubankTaxCalculator->getTax(
            new Operation('sell', 5, 1_000)
        );

        self::assertEquals($taxExpected, $taxGot);
    }

    public function testGetTaxCalculatedFromSellOperation(): void
    {
        $taxExpected = new Tax(35_000);

        $nubankTaxCalculator = new NubankTaxCalculator(
            new WeightedProfitPriceCalculator()
        );
        $nubankTaxCalculator->getTax(
            new Operation('buy', 10, 10_000)
        );
        $taxGot = $nubankTaxCalculator->getTax(
            new Operation('sell', 45, 5_000)
        );

        self::assertEquals($taxExpected, $taxGot);
    }

    public function testGetTaxCalculatedFromSellOperationWithLossAmount(): void
    {
        $taxExpected = new Tax(0);

        $nubankTaxCalculator = new NubankTaxCalculator(
            new WeightedProfitPriceCalculator()
        );
        $nubankTaxCalculator->getTax(
            new Operation('buy', 40, 10_000)
        );
        $taxGot = $nubankTaxCalculator->getTax(
            new Operation('sell', 30, 5_000)
        );

        self::assertEquals($taxExpected, $taxGot);
    }

    public function testGetTaxCalculatedFromSellOperationWithPreviousAndDeductionOfLossAmount(): void
    {
        $taxExpected = new Tax(0);

        $nubankTaxCalculator = new NubankTaxCalculator(
            new WeightedProfitPriceCalculator()
        );
        $nubankTaxCalculator->getTax(
            new Operation('buy', 40, 10_000)
        );
        $nubankTaxCalculator->getTax(
            new Operation('sell', 30, 5_000)
        );
        $taxGot = $nubankTaxCalculator->getTax(
            new Operation('sell', 45, 1_000)
        );

        self::assertEquals($taxExpected, $taxGot);
    }

    public function testGetTaxCalculatedFromSellOperationWithPreviousLossAmount(): void
    {
        $taxExpected = new Tax(20_000);

        $nubankTaxCalculator = new NubankTaxCalculator(
            new WeightedProfitPriceCalculator()
        );
        $nubankTaxCalculator->getTax(
            new Operation('buy', 40, 10_000)
        );
        $nubankTaxCalculator->getTax(
            new Operation('sell', 30, 5_000)
        );//50 prejuizo
        $taxGot = $nubankTaxCalculator->getTax(
            new Operation('sell', 70, 5_000)
        );

        self::assertEquals($taxExpected, $taxGot);
    }
}
