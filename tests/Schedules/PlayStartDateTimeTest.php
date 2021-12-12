<?php

declare(strict_types=1);

namespace Tests\Schedules;

use DomainException;
use PHPUnit\Framework\TestCase;
use TicketPriceModeling\Schedules\PlayStartDateTime;

class PlayStartDateTimeTest extends TestCase
{
    private function playStartDateTimeFacotry(string $datetime): PlayStartDateTime
    {
        return new PlayStartDateTime($datetime);
    }

    /**
     * @test
     */
    public function 上映開始日時は8時より早い時間ではない(): void
    {
        $this->expectException(DomainException::class);
        $this->playStartDateTimeFacotry('2021-12-01 07:59:59');
    }

    /**
     * @test
     */
    public function isWeekdayは平日の場合にtrueを返す(): void
    {
        $this->assertTrue($this->playStartDateTimeFacotry('2021-11-29 08:00:00')->isWeekday());
        $this->assertTrue($this->playStartDateTimeFacotry('2021-12-03 08:00:00')->isWeekday());
    }

    /**
     * @test
     */
    public function isWeekdayは土日の場合にfalseを返す(): void
    {
        $this->assertFalse($this->playStartDateTimeFacotry('2021-12-04 08:00:00')->isWeekday());
        $this->assertFalse($this->playStartDateTimeFacotry('2021-12-05 08:00:00')->isWeekday());
    }

    /**
     * @test
     */
    public function isHolidayは土日の場合にtrueを返す(): void
    {
        $this->assertTrue($this->playStartDateTimeFacotry('2021-12-04 08:00:00')->isHoliday());
        $this->assertTrue($this->playStartDateTimeFacotry('2021-12-05 08:00:00')->isHoliday());
    }

    /**
     * @test
     */
    public function isHolidayは平日の場合にfalseを返す(): void
    {
        $this->assertFalse($this->playStartDateTimeFacotry('2021-11-29 08:00:00')->isHoliday());
        $this->assertFalse($this->playStartDateTimeFacotry('2021-12-03 08:00:00')->isHoliday());
    }

    /**
     * @test
     */
    public function isLateShowは20時以降の場合にtrueを返す(): void
    {
        $this->assertTrue($this->playStartDateTimeFacotry('2021-12-01 20:00:00')->isLateShow());
        $this->assertTrue($this->playStartDateTimeFacotry('2021-12-01 23:00:00')->isLateShow());
    }

    /**
     * @test
     */
    public function isLateShowは20時より早い時間の場合にtrueを返す(): void
    {
        $this->assertFalse($this->playStartDateTimeFacotry('2021-12-01 19:00:00')->isLateShow());
        $this->assertFalse($this->playStartDateTimeFacotry('2021-12-01 08:00:00')->isLateShow());
    }

    /**
     * @test
     */
    public function isCinemaAnniversaryは映画の日の場合にtrueを返す(): void
    {
        $this->assertTrue($this->playStartDateTimeFacotry('2021-11-01 08:00:00')->isCinemaAnniversary());
        $this->assertTrue($this->playStartDateTimeFacotry('2021-12-01 19:00:00')->isCinemaAnniversary());
    }

    /**
     * @test
     */
    public function isCinemaAnniversaryは映画の日ではない場合にfalseを返す(): void
    {
        $this->assertFalse($this->playStartDateTimeFacotry('2021-11-30 23:00:00')->isCinemaAnniversary());
        $this->assertFalse($this->playStartDateTimeFacotry('2021-12-02 08:00:00')->isCinemaAnniversary());
    }
}
