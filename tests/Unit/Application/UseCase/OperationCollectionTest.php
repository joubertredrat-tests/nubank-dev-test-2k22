<?php

declare(strict_types=1);

namespace Nubank\DevTest\Tests\Unit\Application\UseCase;

use Nubank\DevTest\Application\UseCase\OperationCollection;
use Nubank\DevTest\Domain\ValueObject\Operation;
use PHPUnit\Framework\TestCase;

class OperationCollectionTest extends TestCase
{
    public function testCollection(): void
    {
        $collectionExpected = [
            new Operation('buy', 10, 10_000),
            new Operation('buy', 11, 11_000),
            new Operation('buy', 12, 12_000),
        ];

        $operationCollection = new OperationCollection();
        $operationCollection->addOperation(new Operation('buy', 10, 10_000));
        $operationCollection->addOperation(new Operation('buy', 11, 11_000));
        $operationCollection->addOperation(new Operation('buy', 12, 12_000));

        $collectionGot = $operationCollection->getCollection();
        self::assertEquals($collectionExpected, $collectionGot);
    }
}
