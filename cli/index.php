<?php

use Nubank\DevTest\Application\UseCase\GetTaxes;
use Nubank\DevTest\Application\UseCase\NubankTaxCalculator;
use Nubank\DevTest\Application\UseCase\WeightedProfitPriceCalculator;
use Nubank\DevTest\Infra\Factory\OperationCollectionFactory;
use Nubank\DevTest\Infra\Presenter\TaxCollectionPresenter;

require dirname(__DIR__) . '/vendor/autoload.php';

while ($line = \fgets(STDIN)) {
    $line = \strtolower(trim($line));
    $data = \json_decode(\strtolower(trim($line)), true);

    $operationCollection = OperationCollectionFactory::createFromArray($data);

    $getTaxes = new GetTaxes(
        new NubankTaxCalculator(
            new WeightedProfitPriceCalculator()
        )
    );

    $taxCollection = $getTaxes->execute($operationCollection);
    $response = new TaxCollectionPresenter($taxCollection);
    \fwrite(STDOUT, $response->getResponse());
}
