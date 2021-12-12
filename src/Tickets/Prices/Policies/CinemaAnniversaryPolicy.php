<?php

declare(strict_types=1);

namespace TicketPriceModeling\Tickets\Prices\Policies;

use TicketPriceModeling\Customers\Types\CitizenMember;
use TicketPriceModeling\Customers\Types\Disability;
use TicketPriceModeling\Customers\Types\General;
use TicketPriceModeling\Customers\Types\ProfessionalStudent;
use TicketPriceModeling\Customers\Types\Senior;
use TicketPriceModeling\Customers\Types\Type;
use TicketPriceModeling\Customers\Types\UniversityStudent;
use TicketPriceModeling\Tickets\Prices\Price;

class CinemaAnniversaryPolicy extends Policy
{
    public function price(Type $type): Price
    {
        if (
            $type instanceof CitizenMember
            || $type instanceof General
            || $type instanceof UniversityStudent
            || $type instanceof ProfessionalStudent
            || $type instanceof Senior
        ) {
            return new Price(1100);
        } else if ($type instanceof Disability) {
            return new Price(900);
        }

        return new Price(1000);
    }
}
