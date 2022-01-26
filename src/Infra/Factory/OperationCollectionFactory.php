<?php

declare(strict_types=1);

namespace Nubank\DevTest\Infra\Factory;

use Nubank\DevTest\Application\UseCase\OperationCollection;
use Nubank\DevTest\Domain\ValueObject\Operation;

class OperationCollectionFactory
{
    public static function createFromArray(array $data): OperationCollection
    {
        $operationCollection = new OperationCollection();

        foreach ($data as $line) {
            $operationCollection->addOperation(
                new Operation($line['operation'], $line['unit-cost'], $line['quantity'])
            );
        }

        return $operationCollection;
    }
}
