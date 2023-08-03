<?php

declare(strict_types=1);

namespace TicketPriceModeling\Purchase;

use InvalidArgumentException;

class Price
{
    public function __construct(public int $value)
    {
        if ($value <= 0) {
            throw new InvalidArgumentException('Invalid value.');
        }

        $this->value = $value;
    }

    public function value(): int
    {
        return $this->value;
    }

    public function equals(self $age): bool
    {
        return $this->value === $age->value;
    }
}
