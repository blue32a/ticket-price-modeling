<?php

declare(strict_types=1);

namespace TicketPriceModeling\Customers;

use TicketPriceModeling\Customers\Age;
use TicketPriceModeling\Customers\Certificate\CitizenMemberCertificate;
use TicketPriceModeling\Customers\Certificate\DisabilityCertificate;
use TicketPriceModeling\Customers\Certificate\IdentificationCertificate;
use TicketPriceModeling\Customers\Certificate\StudentCertificate;

class Customer
{
    public function __construct(
        private readonly Age $age,
        private readonly ?IdentificationCertificate $identificationCertificate,
        private readonly ?CitizenMemberCertificate $citizenMemberCertificate,
        private readonly ?StudentCertificate $studentCertificate,
        private readonly ?DisabilityCertificate $disabilityCertificate,
    ) {
    }

    public function age(): Age
    {
        return $this->age;
    }

    public function identificationCertificate(): ?IdentificationCertificate
    {
        return $this->identificationCertificate;
    }

    public function citizenMemberCertificate(): ?CitizenMemberCertificate
    {
        return $this->citizenMemberCertificate;
    }

    public function studentCertificate(): ?StudentCertificate
    {
        return $this->studentCertificate;
    }

    public function disabilityCertificate(): ?DisabilityCertificate
    {
        return $this->disabilityCertificate;
    }
}
