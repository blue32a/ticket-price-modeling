<?php

declare(strict_types=1);

namespace TicketPriceModeling\Customers;

use TicketPriceModeling\Customers\Age;
use TicketPriceModeling\Customers\Certificate;
use TicketPriceModeling\Customers\Types\TypeEvaluation;

class Customer
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
        return TypeEvaluation::evaluate($this);
    }
}
