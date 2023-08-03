<?php

declare(strict_types=1);

namespace TicketPriceModeling\Customer\Type\Specification;

use TicketPriceModeling\Customer\Age;
use TicketPriceModeling\Customer\Person;
use TicketPriceModeling\Customer\Type\Type;

class GeneralSpecification extends Specification
{
    public function isSatisfiedBy(Person $person): bool
    {
        return $person->age()->greaterThanOrEqual(new Age(13));
    }

    public function type(): Type
    {
        return Type::General;
    }
}
