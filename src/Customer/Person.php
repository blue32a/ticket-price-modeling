<?php

declare(strict_types=1);

namespace TicketPriceModeling\Customer;

use TicketPriceModeling\Customer\Age;
use TicketPriceModeling\Customer\Certificate;
use TicketPriceModeling\Customer\Type\TypeEvaluation;

class Person
{
    /**
     * @param ?Certificate[] $certificates
     */
    public function __construct(
        private readonly Age $age,
        private readonly ?array $certificates = []
    ) {
    }

    public function age(): Age
    {
        return $this->age;
    }

    public function hasCertificate(Certificate $certificate): bool
    {
        return in_array($certificate, $this->certificates, true);
    }

    public function types(): array
    {
        return (new TypeEvaluation)->evaluate($this);
    }
}
