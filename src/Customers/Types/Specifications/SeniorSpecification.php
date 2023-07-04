<?php

declare(strict_types=1);

namespace TicketPriceModeling\Customers\Types\Specifications;

use TicketPriceModeling\Customers\Age;
use TicketPriceModeling\Customers\Certificate;
use TicketPriceModeling\Customers\Customer;
use TicketPriceModeling\Customers\Types\Type;

class SeniorSpecification extends Specification
{
    public function isSatisfiedBy(Customer $customer): bool
    {
        return $customer->age()->greaterThanOrEqual(new Age(70))
            && $customer->hasCertificate(Certificate::Identification);
    }

    public function type(): Type
    {
        return Type::Senior;
    }
}
