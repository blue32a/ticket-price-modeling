<?php

declare(strict_types=1);

namespace TicketPriceModeling\Customers\Types\Specifications;

use TicketPriceModeling\Customers\Customer;
use TicketPriceModeling\Customers\Certificate\ProfessionalStudentCertificate;

class ProfessionalStudentSpecification extends Specification
{
    public function isSatisfiedBy(Customer $customer): bool
    {
        return $customer->studentCertificate() instanceof ProfessionalStudentCertificate;
    }
}
