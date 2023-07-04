<?php

declare(strict_types=1);

namespace TicketPriceModeling\Customers\Types\Specifications;

use TicketPriceModeling\Customers\Customer;
use TicketPriceModeling\Customers\Types\Type;

abstract class Specification
{
    abstract public function isSatisfiedBy(Customer $customer): bool;
    abstract public function type(): Type;
}
