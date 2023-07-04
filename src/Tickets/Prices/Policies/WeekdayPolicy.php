<?php

declare(strict_types=1);

namespace TicketPriceModeling\Tickets\Prices\Policies;

use TicketPriceModeling\Customers\Types\Type;
use TicketPriceModeling\Tickets\Prices\Price;

class WeekdayPolicy extends Policy
{
    public function price(Type $type): Price
    {
        if ($type === Type::General) {
            return new Price(1800);
        } else if (
            $type === Type::UniversityStudent
            || $type === Type::ProfessionalStudent
        ) {
            return new Price(1500);
        } else if ($type === Type::Senior) {
            return new Price(1100);
        } else if ($type === Type::Disability) {
            return new Price(900);
        }

        return new Price(1000);
    }
}
