<?php

declare(strict_types=1);

namespace TicketPriceModeling\Customers\Types\Specifications;

use TicketPriceModeling\Customers\Customer;

class DisabilitySpecification extends Specification
{
    public function isSatisfiedBy(Customer $customer): bool
    {
        return $customer->disabilityCertificate() !== null;
    }
}
