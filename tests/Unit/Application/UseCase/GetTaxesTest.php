<?php

declare(strict_types=1);

namespace Nubank\DevTest\Tests\Unit\Application\UseCase;

use Nubank\DevTest\Application\UseCase\GetTaxes;
use PHPUnit\Framework\TestCase;

class GetTaxesTest extends TestCase
{
    public function testExecute(): void
    {
        $returnExpected = '[{"tax": 0},{"tax": 0},{"tax": 0}]';

        $getTaxes = new GetTaxes();
        $returnGot = $getTaxes->execute();

        self::assertEquals($returnExpected, $returnGot);
    }
}
