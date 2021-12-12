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
    private Age $age;
    private ?CitizenMemberCertificate $citizenMemberCertificate;
    private ?DisabilityCertificate $disabilityCertificate;
    private ?IdentificationCertificate $identificationCertificate;
    private ?StudentCertificate $studentCertificate;

    public function __construct(
        Age $age,
        ?IdentificationCertificate $identificationCertificate,
        ?CitizenMemberCertificate $citizenMemberCertificate,
        ?StudentCertificate $studentCertificate,
        ?DisabilityCertificate $disabilityCertificate
    ) {
        $this->age = $age;
        $this->identificationCertificate = $identificationCertificate;
        $this->citizenMemberCertificate = $citizenMemberCertificate;
        $this->studentCertificate = $studentCertificate;
        $this->disabilityCertificate = $disabilityCertificate;
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
