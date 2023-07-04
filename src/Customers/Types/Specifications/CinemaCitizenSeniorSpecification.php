<?php

declare(strict_types=1);

namespace TicketPriceModeling\Customers\Types\Specifications;

use TicketPriceModeling\Customers\Customer;
use TicketPriceModeling\Customers\Age;
use TicketPriceModeling\Customers\Types\Type;

class CinemaCitizenSeniorSpecification extends CinemaCitizenSpecification
{
    public function isSatisfiedBy(Customer $customer): bool
    {
        return parent::isSatisfiedBy($customer)
            && $customer->age()->greaterThanOrEqual(new Age(60));
    }

    public function type(): Type
    {
        return Type::CinemaCitizenSenior;
    }
}
