<?php

declare(strict_types=1);

namespace TicketPriceModeling\Customers\Types\Specifications;

use TicketPriceModeling\Customers\Age;
use TicketPriceModeling\Customers\Customer;
use TicketPriceModeling\Customers\Types\Type;

class ChildSpecification extends Specification
{
    public function isSatisfiedBy(Customer $customer): bool
    {
        return $customer->age()->lessThanOrEqual(new Age(12));
    }

    public function type(): Type
    {
        return Type::Child;
    }
}
