<?php

declare(strict_types=1);

namespace Nubank\DevTest\Tests\Unit\Application\UseCase;

use Nubank\DevTest\Application\UseCase\WeightedProfitPriceCalculator;
use Nubank\DevTest\Domain\ValueObject\Operation;
use PHPUnit\Framework\TestCase;

class WeightedProfitPriceCalculatorTest extends TestCase
{
    public function testGetPrice(): void
    {
        $priceExpected = 12.2;

        $weightedProfitPriceCalculator = new WeightedProfitPriceCalculator();
        $weightedProfitPriceCalculator->addBuyOperation(
            new Operation('buy', 12, 1_000)
        );
        $weightedProfitPriceCalculator->addBuyOperation(
            new Operation('buy', 13, 250)
        );
        $weightedProfitPriceCalculator->addBuyOperation(
            new Operation('sell', 30, 500)
        );
        $priceGot = $weightedProfitPriceCalculator->getPrice();

        self::assertEquals($priceExpected, $priceGot);
    }
}
