<?php

declare(strict_types=1);

namespace TicketPriceModeling\Purchase;

use TicketPriceModeling\Customer\Type\Type as CustomerType;
use TicketPriceModeling\Screening\ShowTime\Type as ShowTimeType;

class BasePricePolicy
{
    private array $priceMap;

    public function __construct()
    {
        $this->priceMap = [
            CustomerType::CinemaCitizen->value => [
                ShowTimeType::WeekdayEarly->value => 1000,
                ShowTimeType::WeekdayLate->value => 1000,
                ShowTimeType::HolidayEarly->value => 1300,
                ShowTimeType::HolidayLate->value => 1000,
                ShowTimeType::CinemaAnniversary->value => 1100,
            ],
            CustomerType::CinemaCitizenSenior->value => [
                ShowTimeType::WeekdayEarly->value => 1000,
                ShowTimeType::WeekdayLate->value => 1000,
                ShowTimeType::HolidayEarly->value => 1000,
                ShowTimeType::HolidayLate->value => 1000,
                ShowTimeType::CinemaAnniversary->value => 1000,
            ],
            CustomerType::General->value => [
                ShowTimeType::WeekdayEarly->value => 1800,
                ShowTimeType::WeekdayLate->value => 1300,
                ShowTimeType::HolidayEarly->value => 1800,
                ShowTimeType::HolidayLate->value => 1300,
                ShowTimeType::CinemaAnniversary->value => 1100,
            ],
            CustomerType::Senior->value => [
                ShowTimeType::WeekdayEarly->value => 1100,
                ShowTimeType::WeekdayLate->value => 1100,
                ShowTimeType::HolidayEarly->value => 1100,
                ShowTimeType::HolidayLate->value => 1100,
                ShowTimeType::CinemaAnniversary->value => 1100,
            ],
            CustomerType::UniversityStudent->value => [
                ShowTimeType::WeekdayEarly->value => 1500,
                ShowTimeType::WeekdayLate->value => 1300,
                ShowTimeType::HolidayEarly->value => 1500,
                ShowTimeType::HolidayLate->value => 1300,
                ShowTimeType::CinemaAnniversary->value => 1100,
            ],
            CustomerType::ProfessionalStudent->value => [
                ShowTimeType::WeekdayEarly->value => 1500,
                ShowTimeType::WeekdayLate->value => 1300,
                ShowTimeType::HolidayEarly->value => 1500,
                ShowTimeType::HolidayLate->value => 1300,
                ShowTimeType::CinemaAnniversary->value => 1100,
            ],
            CustomerType::HighSchoolStudent->value => [
                ShowTimeType::WeekdayEarly->value => 1000,
                ShowTimeType::WeekdayLate->value => 1000,
                ShowTimeType::HolidayEarly->value => 1000,
                ShowTimeType::HolidayLate->value => 1000,
                ShowTimeType::CinemaAnniversary->value => 1000,
            ],
            CustomerType::MiddleSchoolStudent->value => [
                ShowTimeType::WeekdayEarly->value => 1000,
                ShowTimeType::WeekdayLate->value => 1000,
                ShowTimeType::HolidayEarly->value => 1000,
                ShowTimeType::HolidayLate->value => 1000,
                ShowTimeType::CinemaAnniversary->value => 1000,
            ],
            CustomerType::Child->value => [
                ShowTimeType::WeekdayEarly->value => 1000,
                ShowTimeType::WeekdayLate->value => 1000,
                ShowTimeType::HolidayEarly->value => 1000,
                ShowTimeType::HolidayLate->value => 1000,
                ShowTimeType::CinemaAnniversary->value => 1000,
            ],
            CustomerType::Disability->value => [
                ShowTimeType::WeekdayEarly->value => 900,
                ShowTimeType::WeekdayLate->value => 900,
                ShowTimeType::HolidayEarly->value => 900,
                ShowTimeType::HolidayLate->value => 900,
                ShowTimeType::CinemaAnniversary->value => 900,
            ],
        ];
    }

    public function get(CustomerType $customerType, ShowTimeType $showTimeType): Price
    {
        $priceValue = $this->priceMap[$customerType->value][$showTimeType->value] ?? null;

        return new Price($priceValue);
    }
}
