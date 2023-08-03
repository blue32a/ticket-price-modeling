<?php

declare(strict_types=1);

namespace TicketPriceModeling\Customer\Type\Specification;

use TicketPriceModeling\Customer\Age;
use TicketPriceModeling\Customer\Person;
use TicketPriceModeling\Customer\Type\Type;

class ChildSpecification extends Specification
{
    public function isSatisfiedBy(Person $person): bool
    {
        return $person->age()->lessThanOrEqual(new Age(12));
    }

    public function type(): Type
    {
        return Type::Child;
    }
}
