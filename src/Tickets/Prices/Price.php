<?php

declare(strict_types=1);

namespace TicketPriceModeling\Tickets\Prices;

use DomainException;

class Price
{
    private int $value;

    public function __construct(int $value)
    {
        if ($value <= 0) {
            throw new DomainException('Invalid value.');
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
