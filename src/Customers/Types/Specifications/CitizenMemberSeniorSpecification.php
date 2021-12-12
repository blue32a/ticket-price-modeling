<?php

declare(strict_types=1);

namespace TicketPriceModeling\Customers\Types\Specifications;

use TicketPriceModeling\Customers\Customer;
use TicketPriceModeling\Customers\Age;

class CitizenMemberSeniorSpecification extends CitizenMemberSpecification
{
    public function isSatisfiedBy(Customer $customer): bool
    {
        return parent::isSatisfiedBy($customer)
            && $customer->age()->greaterThanOrEqual(new Age(60));
    }
}
