<?php

declare(strict_types=1);

namespace Nubank\DevTest\Domain\ValueObject;

use Nubank\DevTest\Domain\Exception\ValueObject\Operation\InvalidTypeException;

use function in_array;

class Operation
{
    private const TYPE_BUY = "buy";
    private const TYPE_SELL = "sell";
    private string $type;
    private int $unitCost;
    private int $quantity;

    public function __construct(string $type, int $unitCost, int $quantity)
    {
        if (!self::isValidType($type)) {
            throw InvalidTypeException::throwNew($type, self::getTypesAvailable());
        }
        $this->type = $type;
        $this->unitCost = $unitCost;
        $this->quantity = $quantity;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function isTypeBuy(): bool
    {
        return $this->type === self::TYPE_BUY;
    }

    public function isTypeSell(): bool
    {
        return $this->type === self::TYPE_SELL;
    }

    public function getUnitCost(): int
    {
        return $this->unitCost;
    }

    public function getQuantity(): int
    {
        return $this->quantity;
    }

    private static function isValidType(string $type): bool
    {
        return in_array($type, self::getTypesAvailable());
    }

    private static function getTypesAvailable(): array
    {
        return [self::TYPE_BUY, self::TYPE_SELL];
    }
}
