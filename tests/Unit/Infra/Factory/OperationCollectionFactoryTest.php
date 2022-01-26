<?php

declare(strict_types=1);

namespace Nubank\DevTest\Tests\Unit\Infra\Factory;

use Nubank\DevTest\Application\UseCase\OperationCollection;
use Nubank\DevTest\Domain\ValueObject\Operation;
use Nubank\DevTest\Infra\Factory\OperationCollectionFactory;
use PHPUnit\Framework\TestCase;

class OperationCollectionFactoryTest extends TestCase
{
    public function testCreateFromArray(): void
    {
        $operationCollectionExpected = new OperationCollection();
        $operationCollectionExpected->addOperation(new Operation("buy", 10, 17_000));
        $operationCollectionExpected->addOperation(new Operation("buy", 16, 21_000));
        $operationCollectionExpected->addOperation(new Operation("sell", 45, 6_000));

        $data = [
            ['operation' => 'buy', 'unit-cost' => 10, 'quantity' => 17_000],
            ['operation' => 'buy', 'unit-cost' => 16, 'quantity' => 21_000],
            ['operation' => 'sell', 'unit-cost' => 45, 'quantity' => 6_000],
        ];

        $operationCollectionGot = OperationCollectionFactory::createFromArray($data);
        self::assertEquals($operationCollectionExpected, $operationCollectionGot);
    }
}
