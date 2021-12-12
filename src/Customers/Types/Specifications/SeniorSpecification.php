<?php

declare(strict_types=1);

namespace TicketPriceModeling\Customers\Types\Specifications;

use TicketPriceModeling\Customers\Age;
use TicketPriceModeling\Customers\Customer;

class SeniorSpecification extends Specification
{
    public function isSatisfiedBy(Customer $customer): bool
    {
        return $customer->age()->greaterThanOrEqual(new Age(70))
            && $customer->identificationCertificate() !== null;
    }
}
