<?php

declare(strict_types=1);

namespace Nubank\DevTest\Tests\Unit\Domain\ValueObject;

use Nubank\DevTest\Domain\Exception\ValueObject\Operation\InvalidTypeException;
use Nubank\DevTest\Domain\ValueObject\Operation;
use PHPUnit\Framework\TestCase;

class OperationTest extends TestCase
{
    public function testConstruct(): void
    {
        $operation = new Operation('buy', 12, 1_000);

        self::assertEquals(12, $operation->getUnitCost());
        self::assertEquals(1_000, $operation->getQuantity());
        self::assertEquals(12_000, $operation->getTotal());
        self::assertTrue($operation->isTypeBuy());
        self::assertFalse($operation->isTypeSell());
        self::assertFalse($operation->isTaxExemption());
    }

    public function testConstructWithInvalidType(): void
    {
        self::expectException(InvalidTypeException::class);

        new Operation('refund', 12, 1_000);
    }
}
