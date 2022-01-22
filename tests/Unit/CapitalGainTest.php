<?php

declare(strict_types=1);

namespace Nubank\DevTest\Tests\Unit;

use PHPUnit\Framework\TestCase;

class CapitalGainTest extends TestCase
{
    public function testCase1(): void
    {
        $returnExpected = '[{"tax": 0},{"tax": 0},{"tax": 0}]';
        $returnGot = '';

        self::assertEquals($returnExpected, $returnGot);
    }
}
