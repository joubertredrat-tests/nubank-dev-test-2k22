<?php

declare(strict_types=1);

namespace Nubank\DevTest\Infra\Presenter;

use Nubank\DevTest\Application\UseCase\TaxCollection;
use Nubank\DevTest\Domain\ValueObject\Tax;

use function json_encode;

class TaxResponsePresenter
{
    private TaxCollection $taxCollection;

    public function __construct(TaxCollection $taxCollection)
    {
        $this->taxCollection = $taxCollection;
    }

    public function getResponse(): string
    {
        $response = [];

        /** @var Tax $tax */
        foreach ($this->taxCollection->getCollection() as $tax) {
            $response[] = ['tax' => $tax->getAmount()];
        }

        return json_encode($response);
    }
}
