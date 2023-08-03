<?php

declare(strict_types=1);

namespace TicketPriceModeling\Customer\Type\Specification;

use TicketPriceModeling\Customer\Certificate;
use TicketPriceModeling\Customer\Person;
use TicketPriceModeling\Customer\Type\Type;

class CinemaCitizenSpecification extends Specification
{
    public function isSatisfiedBy(Person $person): bool
    {
        return $person->hasCertificate(Certificate::CinemaCitizen);
    }

    public function type(): Type
    {
        return Type::CinemaCitizen;
    }
}
