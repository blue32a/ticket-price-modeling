<?php

declare(strict_types=1);

namespace TicketPriceModeling\Customers\Types\Specifications;

use TicketPriceModeling\Customers\Age;
use TicketPriceModeling\Customers\Customer;

class ChildSpecification extends Specification
{
    public function isSatisfiedBy(Customer $customer): bool
    {
        return $customer->age()->lessThanOrEqual(new Age(12));
    }
}
