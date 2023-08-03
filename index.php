<?php

require_once './vendor/autoload.php';

use TicketPriceModeling\Customer\Age;
use TicketPriceModeling\Customer\Certificate;
use TicketPriceModeling\Customer\Person;
use TicketPriceModeling\Purchase\PriceCalculator;
use TicketPriceModeling\Screening\ShowTime\StartAt;

$person = new Person(new Age(19), [
    Certificate::UniversityStudent,
    Certificate::CinemaCitizen,
]);

$priceCalculator = new PriceCalculator();


$finalAmount = $priceCalculator->calculate(
    $person,
    new StartAt(new DateTimeImmutable('2023-07-02 10:00:00'))
);

echo sprintf('料金は%s円です。', number_format($finalAmount->value()));
echo "\n";
