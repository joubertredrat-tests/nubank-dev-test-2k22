<?php

declare(strict_types=1);

namespace Nubank\DevTest\Tests\Unit\Application\UseCase;

use Nubank\DevTest\Application\UseCase\TaxCollection;
use Nubank\DevTest\Domain\ValueObject\Tax;
use PHPUnit\Framework\TestCase;

class TaxCollectionTest extends TestCase
{
    public function testCollection(): void
    {
        $collectionExpected = [
            new Tax(10),
            new Tax(11),
            new Tax(12),
        ];

        $taxCollection = new TaxCollection();
        $taxCollection->addTax(new Tax(10));
        $taxCollection->addTax(new Tax(11));
        $taxCollection->addTax(new Tax(12));

        $collectionGot = $taxCollection->getCollection();
        self::assertEquals($collectionExpected, $collectionGot);
    }
}
