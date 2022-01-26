<?php

declare(strict_types=1);

namespace Nubank\DevTest\Tests\Unit\Infra\Presenter;

use Nubank\DevTest\Application\UseCase\TaxCollection;
use Nubank\DevTest\Domain\ValueObject\Tax;
use Nubank\DevTest\Infra\Presenter\TaxCollectionPresenter;
use PHPUnit\Framework\TestCase;

class TaxCollectionPresenterTest extends TestCase
{
    public function testGetResponse(): void
    {
        $responseExpected = '[{"tax":10},{"tax":11},{"tax":12}]';

        $taxCollection = new TaxCollection();
        $taxCollection->addTax(new Tax(10));
        $taxCollection->addTax(new Tax(11));
        $taxCollection->addTax(new Tax(12));

        $taxCollectionPresenter = new TaxCollectionPresenter($taxCollection);
        $responseGot = $taxCollectionPresenter->getResponse();

        self::assertEquals($responseExpected, $responseGot);
    }
}
