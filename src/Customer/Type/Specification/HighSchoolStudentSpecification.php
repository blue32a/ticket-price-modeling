<?php

declare(strict_types=1);

namespace TicketPriceModeling\Customer\Type\Specification;

use TicketPriceModeling\Customer\Certificate;
use TicketPriceModeling\Customer\Person;
use TicketPriceModeling\Customer\Type\Type;

class HighSchoolStudentSpecification extends Specification
{
    public function isSatisfiedBy(Person $person): bool
    {
        return $person->hasCertificate(Certificate::HighSchoolStudent);
    }

    public function type(): Type
    {
        return Type::HighSchoolStudent;
    }
}
