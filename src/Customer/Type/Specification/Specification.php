<?php

declare(strict_types=1);

namespace TicketPriceModeling\Customer\Type\Specification;

use TicketPriceModeling\Customer\Person;
use TicketPriceModeling\Customer\Type\Type;

abstract class Specification
{
    abstract public function isSatisfiedBy(Person $person): bool;
    abstract public function type(): Type;
}
