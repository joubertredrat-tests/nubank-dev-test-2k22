<?php

declare(strict_types=1);

namespace Nubank\DevTest\Tests\Unit\Application\UseCase;

use Nubank\DevTest\Application\UseCase\GetTaxes;
use Nubank\DevTest\Application\UseCase\OperationCollection;
use Nubank\DevTest\Application\UseCase\TaxCollection;
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

        $getTaxes = new GetTaxes();
        $returnGot = $getTaxes->execute($collection);

        self::assertEquals($returnExpected, $returnGot);
    }
}
