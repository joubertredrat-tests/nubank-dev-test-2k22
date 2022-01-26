<?php

declare(strict_types=1);

namespace Nubank\DevTest\Tests\Unit\Domain\Exception\ValueObject\Operation;

use Nubank\DevTest\Domain\Exception\ValueObject\Operation\InvalidTypeException;
use PHPUnit\Framework\TestCase;

class InvalidTypeExceptionTest extends TestCase
{
    public function testThrowNew(): void
    {
        self::expectException(InvalidTypeException::class);
        self::expectExceptionMessage('Invalid type got [ refund ], types available, [ buy, sell ]');

        throw InvalidTypeException::throwNew('refund', ['buy', 'sell']);
    }
}
