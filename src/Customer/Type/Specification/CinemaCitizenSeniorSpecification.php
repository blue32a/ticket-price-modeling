<?php

declare(strict_types=1);

namespace TicketPriceModeling\Customer\Type\Specification;

use TicketPriceModeling\Customer\Age;
use TicketPriceModeling\Customer\Person;
use TicketPriceModeling\Customer\Type\Type;

class CinemaCitizenSeniorSpecification extends CinemaCitizenSpecification
{
    public function isSatisfiedBy(Person $person): bool
    {
        return parent::isSatisfiedBy($person)
            && $person->age()->greaterThanOrEqual(new Age(60));
    }

    public function type(): Type
    {
        return Type::CinemaCitizenSenior;
    }
}
