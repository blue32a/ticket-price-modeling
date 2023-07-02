<?php

declare(strict_types=1);

namespace TicketPriceModeling\Customers\Types\Specifications;

use TicketPriceModeling\Customers\Certificate;
use TicketPriceModeling\Customers\Customer;

class CinemaCitizenSpecification extends Specification
{
    public function isSatisfiedBy(Customer $customer): bool
    {
        return $customer->hasCertificate(Certificate::CinemaCitizen);
    }
}