<?php

declare(strict_types=1);

namespace TicketPriceModeling\Customers\Types\Specifications;

use TicketPriceModeling\Customers\Age;
use TicketPriceModeling\Customers\Customer;
use TicketPriceModeling\Customers\Types\Type;

class GeneralSpecification extends Specification
{
    public function isSatisfiedBy(Customer $customer): bool
    {
        return $customer->age()->greaterThanOrEqual(new Age(13));
    }

    public function type(): Type
    {
        return Type::General;
    }
}
