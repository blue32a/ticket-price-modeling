<?php

declare(strict_types=1);

namespace TicketPriceModeling\Tickets\Prices\Policies;

use TicketPriceModeling\Customers\Types\Type;
use TicketPriceModeling\Tickets\Prices\Price;

abstract class Policy
{
    abstract public function price(Type $type): Price;
}
