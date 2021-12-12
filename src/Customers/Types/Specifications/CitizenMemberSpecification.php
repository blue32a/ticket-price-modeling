<?php

declare(strict_types=1);

namespace TicketPriceModeling\Customers\Types\Specifications;

use TicketPriceModeling\Customers\Customer;

class CitizenMemberSpecification extends Specification
{
    public function isSatisfiedBy(Customer $customer): bool
    {
        return $customer->citizenMemberCertificate() !== null;
    }
}
