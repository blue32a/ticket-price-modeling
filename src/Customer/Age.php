<?php

declare(strict_types=1);

namespace TicketPriceModeling\Customer;

use DomainException;

class Age
{
    private int $value;

    public function __construct(int $value)
    {
        if ($value < 3){
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

    public function greaterThanOrEqual(self $age): bool
    {
        return $this->value >= $age->value;
    }

    public function lessThanOrEqual(self $age): bool
    {
        return $this->value <= $age->value;
    }
}
