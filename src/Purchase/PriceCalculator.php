<?php

declare(strict_types=1);

namespace TicketPriceModeling\Purchase;

use TicketPriceModeling\Customer\Person;
use TicketPriceModeling\Screening\ShowTime\StartAt;
use TicketPriceModeling\Screening\ShowTime\Type;

class PriceCalculator
{
    private BasePricePolicy $basePricePolicy;

    public function __construct()
    {
        $this->basePricePolicy = new BasePricePolicy();
    }

    public function calculate(Person $person, StartAt $startAt): Price
    {
        $showTimeType = Type::evaluate($startAt);

        $prices = array_reduce($person->types(), function ($prices, $customerType) use ($showTimeType) {
            $prices[] = $this->basePricePolicy->get($customerType, $showTimeType);
            return $prices;
        }, []);

        $minPrice = array_reduce($prices, function ($min, $current) {
            return !$min || $current->value() < $min->value() ? $current : $min;
        });

        return $minPrice;
    }
}
