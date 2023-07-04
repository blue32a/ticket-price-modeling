<?php

declare(strict_types=1);

namespace TicketPriceModeling\Customers\Types\Specifications;

use TicketPriceModeling\Customers\Certificate;
use TicketPriceModeling\Customers\Customer;
use TicketPriceModeling\Customers\Types\Type;

class CinemaCitizenSpecification extends Specification
{
    public function isSatisfiedBy(Customer $customer): bool
    {
        return $customer->hasCertificate(Certificate::CinemaCitizen);
    }

    public function type(): Type
    {
        return Type::CinemaCitizen;
    }
}
