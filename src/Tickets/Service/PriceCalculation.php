<?php

declare(strict_types=1);

namespace TicketPriceModeling\Tickets\Service;

use TicketPriceModeling\Customers\Customer;
use TicketPriceModeling\Schedules\PlayStartDateTime;
use TicketPriceModeling\Tickets\Prices\Policies\CinemaAnniversaryPolicy;
use TicketPriceModeling\Tickets\Prices\Policies\HolidayPolicy;
use TicketPriceModeling\Tickets\Prices\Policies\LateShowPolicy;
use TicketPriceModeling\Tickets\Prices\Policies\Policy;
use TicketPriceModeling\Tickets\Prices\Policies\WeekdayPolicy;
use TicketPriceModeling\Tickets\Prices\Price;

class PriceCalculation
{
    public static function caluculation(PlayStartDateTime $playStartDateTime, Customer $customer): Price
    {
        $policy = self::policy($playStartDateTime);

        $types = $customer->types();
        $prices = [];

        foreach($types as $type) {
            $prices[] = $policy->price($type);
        }

        usort($prices, function(Price $a, Price $b) {
            if ($a->equals($b)) {
                return 0;
            } else if ($a->value() > $b->value()) {
                return 1;
            }
            return -1;
        });

        return $prices[0];
    }

    public static function policy(PlayStartDateTime $playStartDateTime): Policy
    {
        if ($playStartDateTime->isCinemaAnniversary()) {
            return new CinemaAnniversaryPolicy();
        } else if ($playStartDateTime->isLateShow()) {
            return new LateShowPolicy();
        } else if ($playStartDateTime->isHoliday()) {
            return new HolidayPolicy();
        }
        return new WeekdayPolicy();
    }
}
