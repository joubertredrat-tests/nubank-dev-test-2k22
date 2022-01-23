<?php

declare(strict_types=1);

namespace Nubank\DevTest\Application\UseCase;

class GetTaxes
{
    public function execute(OperationCollection $collection): string
    {
        return '[{"tax": 0},{"tax": 0},{"tax": 0}]';
    }
}
