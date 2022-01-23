<?php

declare(strict_types=1);

namespace Nubank\DevTest\Application\UseCase;

use PHPUnit\Framework\TestCase;

class GetTaxes extends TestCase
{
    public function execute(): string
    {
        return '[{"tax": 0},{"tax": 0},{"tax": 0}]';
    }
}
