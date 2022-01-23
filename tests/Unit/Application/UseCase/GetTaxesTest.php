<?php

declare(strict_types=1);

namespace Nubank\DevTest\Tests\Unit\Application\UseCase;

use Nubank\DevTest\Application\UseCase\GetTaxes;
use Nubank\DevTest\Application\UseCase\OperationCollection;
use Nubank\DevTest\Domain\ValueObject\Operation;
use PHPUnit\Framework\TestCase;

class GetTaxesTest extends TestCase
{
    public function testExecute(): void
    {
        $returnExpected = '[{"tax": 0},{"tax": 0},{"tax": 0}]';

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
