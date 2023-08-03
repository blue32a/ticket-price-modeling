<?php

declare(strict_types=1);

namespace TicketPriceModeling\Screening\ShowTime;

enum Type: string
{
    case WeekdayEarly = '1';
    case WeekdayLate = '2';
    case HolidayEarly = '3';
    case HolidayLate = '4';
    case CinemaAnniversary = '5';

    public static function evaluate(StartAt $startAt): static
    {
        return match (true) {
            $startAt->isCinemaAnniversary() => self::CinemaAnniversary,
            $startAt->isHoliday() && $startAt->isLateShow() => self::HolidayLate,
            $startAt->isHoliday() && !$startAt->isLateShow() => self::HolidayEarly,
            $startAt->isWeekday() && $startAt->isLateShow() => self::WeekdayLate,
            $startAt->isWeekday() && !$startAt->isLateShow() => self::WeekdayEarly,
        };
    }
}
