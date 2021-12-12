<?php

declare(strict_types=1);

namespace TicketPriceModeling\Schedules;

use DateTime;
use DomainException;

class PlayStartDateTime
{
    private const START_HOUR = 8;
    private const RATE_SHOW_START_HOUR = 20;

    private DateTime $value;

    public function __construct(string $datetime)
    {
        $value = new DateTime($datetime);

        if ((int) $value->format('G') < self::START_HOUR) {
            throw new DomainException('Invalid value.');
        }

        $this->value = $value;
    }

    public function isWeekday(): bool
    {
        $week = (int) $this->value->format('N');
        return $week >= 1 && $week <= 5;
    }

    public function isHoliday(): bool
    {
        return !$this->isWeekday();
    }

    public function isLateShow(): bool
    {
        return (int) $this->value->format('G') >= self::RATE_SHOW_START_HOUR;
    }

    public function isCinemaAnniversary(): bool
    {
        return $this->value->format('j') === '1';
    }
}
