<?php

declare(strict_types=1);

namespace TicketPriceModeling\Screening\ShowTime;

use InvalidArgumentException;

readonly class StartAt
{
    private const START_HOUR = 8;
    private const RATE_SHOW_START_HOUR = 20;

    public function __construct(public \DateTimeImmutable $value) {
        if ((int) $value->format('G') < self::START_HOUR) {
            throw new InvalidArgumentException('Invalid startAt.');
        }
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
