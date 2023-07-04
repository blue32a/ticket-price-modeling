<?php

declare(strict_types=1);

namespace TicketPriceModeling\Customers\Types\Specifications;

use TicketPriceModeling\Customers\Certificate;
use TicketPriceModeling\Customers\Customer;
use TicketPriceModeling\Customers\Types\Type;

class UniversityStudentSpecification extends Specification
{
    public function isSatisfiedBy(Customer $customer): bool
    {
        return $customer->hasCertificate(Certificate::UniversityStudent);
    }

    public function type(): Type
    {
        return Type::UniversityStudent;
    }
}
