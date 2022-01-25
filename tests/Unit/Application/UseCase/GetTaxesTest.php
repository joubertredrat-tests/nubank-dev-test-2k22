<?php

declare(strict_types=1);

namespace Nubank\DevTest\Tests\Unit\Application\UseCase;

use Nubank\DevTest\Application\UseCase\GetTaxes;
use Nubank\DevTest\Application\UseCase\NubankTaxCalculator;
use Nubank\DevTest\Application\UseCase\OperationCollection;
use Nubank\DevTest\Application\UseCase\TaxCollection;
use Nubank\DevTest\Application\UseCase\WeightedPriceCalculator;
use Nubank\DevTest\Domain\ValueObject\Operation;
use Nubank\DevTest\Domain\ValueObject\Tax;
use PHPUnit\Framework\TestCase;

class GetTaxesTest extends TestCase
{
    public function testExecuteCase1(): void
    {
        $returnExpected = new TaxCollection();
        $returnExpected->addTax(new Tax(0));
        $returnExpected->addTax(new Tax(0));
        $returnExpected->addTax(new Tax(0));

        $collection = new OperationCollection();
        $collection->addOperation(
            new Operation("buy", 10, 100)
        );
        $collection->addOperation(
            new Operation("sell", 15, 50)
        );
        $collection->addOperation(
            new Operation("sell", 15, 50)
        );

        $getTaxes = new GetTaxes(
            new NubankTaxCalculator(
                new WeightedPriceCalculator()
            )
        );
        $returnGot = $getTaxes->execute($collection);

        self::assertEquals($returnExpected, $returnGot);
    }

    //[
    //      {"operation":"buy", "unit-cost":10, "quantity": 10000},
    //      {"operation":"sell", "unit-cost":20, "quantity": 5000},
    //      {"operation":"sell", "unit-cost":5, "quantity": 5000}
    //]
    public function testExecuteCase2(): void
    {
        $returnExpected = new TaxCollection();
        $returnExpected->addTax(new Tax(0));
        $returnExpected->addTax(new Tax(10_000));
        $returnExpected->addTax(new Tax(0));

        $collection = new OperationCollection();
        $collection->addOperation(
            new Operation("buy", 10, 10_000)
        );
        $collection->addOperation(
            new Operation("sell", 20, 5_000)
        );
        $collection->addOperation(
            new Operation("sell", 5, 5_000)
        );

        $getTaxes = new GetTaxes(
            new NubankTaxCalculator(
                new WeightedPriceCalculator()
            )
        );
        $returnGot = $getTaxes->execute($collection);

        self::assertEquals($returnExpected, $returnGot);
    }

    //[
    //      {"operation":"buy", "unit-cost":10, "quantity": 10000},
    //      {"operation":"sell", "unit-cost":5, "quantity": 5000},
    //      {"operation":"sell", "unit-cost":20, "quantity": 5000}
    //]
    public function testExecuteCase3(): void
    {
        $returnExpected = new TaxCollection();
        $returnExpected->addTax(new Tax(0));
        $returnExpected->addTax(new Tax(0));
        $returnExpected->addTax(new Tax(5_000));

        $collection = new OperationCollection();
        $collection->addOperation(
            new Operation("buy", 10, 10_000)
        );
        $collection->addOperation(
            new Operation("sell", 5, 5_000)
        );
        $collection->addOperation(
            new Operation("sell", 20, 5_000)
        );

        $getTaxes = new GetTaxes(
            new NubankTaxCalculator(
                new WeightedPriceCalculator()
            )
        );
        $returnGot = $getTaxes->execute($collection);

        self::assertEquals($returnExpected, $returnGot);
    }

    //[
    //      {"operation":"buy", "unit-cost":10, "quantity": 10000},
    //      {"operation":"buy", "unit-cost":25, "quantity": 5000},
    //      {"operation":"sell", "unit-cost":15, "quantity": 10000}
    //]
    public function testExecuteCase4(): void
    {
        $returnExpected = new TaxCollection();
        $returnExpected->addTax(new Tax(0));
        $returnExpected->addTax(new Tax(0));
        $returnExpected->addTax(new Tax(0));

        $collection = new OperationCollection();
        $collection->addOperation(
            new Operation("buy", 10, 10_000)
        );
        $collection->addOperation(
            new Operation("buy", 25, 5_000)
        );
        $collection->addOperation(
            new Operation("sell", 15, 10_000)
        );

        $getTaxes = new GetTaxes(
            new NubankTaxCalculator(
                new WeightedPriceCalculator()
            )
        );
        $returnGot = $getTaxes->execute($collection);

        self::assertEquals($returnExpected, $returnGot);
    }
}
