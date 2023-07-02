<?php

require_once './vendor/autoload.php';

use TicketPriceModeling\Customers\Age;
use TicketPriceModeling\Customers\Certificate;
use TicketPriceModeling\Customers\Customer;
use TicketPriceModeling\Schedules\PlayStartDateTime;
use TicketPriceModeling\Tickets\Service\PriceCalculation;

$middleSchoolStudent = new Customer(new Age(14), [Certificate::MiddleSchoolStudent]);
$price = PriceCalculation::caluculation(
    new PlayStartDateTime('2021-12-02 10:00:00'),
    $middleSchoolStudent
);
echo sprintf('平日通常時間、中学生の料金は%s円です。', number_format($price->value()));
echo "\n";

$senior = new Customer(new Age(70), [Certificate::Identification]);
$price = PriceCalculation::caluculation(
    new PlayStartDateTime('2021-12-04 22:00:00'),
    $senior
);
echo sprintf('休日レイトショー、シニアの料金は%s円です。', number_format($price->value()));
echo "\n";

$general = new Customer(new Age(19));
$price = PriceCalculation::caluculation(
    new PlayStartDateTime('2021-12-05 15:00:00'),
    $general
);
echo sprintf('休日通常時間、一般の料金は%s円です。', number_format($price->value()));
echo "\n";
