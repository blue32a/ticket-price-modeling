<?php

declare(strict_types=1);

namespace Tests\Schedules;

use DateTimeImmutable;
use DomainException;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use TicketPriceModeling\Schedules\PlayStartDateTime;

class PlayStartDateTimeTest extends TestCase
{
    private function facotryPlayStartDateTime(string $datetime): PlayStartDateTime
    {
        return new PlayStartDateTime(new DateTimeImmutable($datetime));
    }

    #[Test]
    public function 上映開始日時は8時より早い時間ではない(): void
    {
        $this->expectException(DomainException::class);
        $this->facotryPlayStartDateTime('2021-12-01 07:59:59');
    }

    #[DataProvider('weekDayDataProvider')]
    #[Test]
    public function isWeekdayは平日の場合にtrueを返す(string $datetime): void
    {
        $sut = $this->facotryPlayStartDateTime($datetime);

        $this->assertTrue($sut->isWeekday());
    }

    #[DataProvider('holidayDataProvider')]
    #[Test]
    public function isWeekdayは休日の場合にfalseを返す(string $datetime): void
    {
        $sut = $this->facotryPlayStartDateTime($datetime);

        $this->assertFalse($sut->isWeekday());
    }

    #[DataProvider('holidayDataProvider')]
    #[Test]
    public function isHolidayは休日の場合にtrueを返す(string $datetime): void
    {
        $sut = $this->facotryPlayStartDateTime($datetime);

        $this->assertTrue($sut->isHoliday());
    }

    #[DataProvider('weekDayDataProvider')]
    #[Test]
    public function isHolidayは平日の場合にfalseを返す(string $datetime): void
    {
        $sut = $this->facotryPlayStartDateTime($datetime);

        $this->assertFalse($sut->isHoliday());
    }

    public static function weekDayDataProvider(): array
    {
        return [
            '月曜日' => ['2021-11-29 08:00:00'],
            '火曜日' => ['2021-11-30 08:00:00'],
            '水曜日' => ['2021-12-01 08:00:00'],
            '木曜日' => ['2021-12-02 08:00:00'],
            '金曜日' => ['2021-12-03 08:00:00'],
        ];
    }

    public static function holidayDataProvider(): array
    {
        return [
            '土曜日' => ['2021-12-04 08:00:00'],
            '日曜日' => ['2021-12-05 08:00:00'],
        ];
    }

    #[Test]
    public function isLateShowは20時以降の場合にtrueを返す(): void
    {
        $sut = $this->facotryPlayStartDateTime('2021-12-01 20:00:00');

        $this->assertTrue($sut->isLateShow());
    }

    #[Test]
    public function isLateShowは20時より早い時間の場合にfalseを返す(): void
    {
        $sut = $this->facotryPlayStartDateTime('2021-12-01 19:59:59');

        $this->assertFalse($sut->isLateShow());
    }

    #[Test]
    public function isCinemaAnniversaryは映画の日の場合にtrueを返す(): void
    {
        $sut = $this->facotryPlayStartDateTime('2021-11-01 08:00:00');

        $this->assertTrue($sut->isCinemaAnniversary());
    }

    #[DataProvider('notCinemaAnniversaryProvider')]
    #[Test]
    public function isCinemaAnniversaryは映画の日ではない場合にfalseを返す(string $datetime): void
    {
        $sut = $this->facotryPlayStartDateTime($datetime);

        $this->assertFalse($sut->isCinemaAnniversary());
    }

    public static function notCinemaAnniversaryProvider(): array
    {
        return [
            '1日の前日' => ['2021-11-30 23:59:59'],
            '1日の翌日' => ['2021-12-02 08:00:00'],
        ];
    }
}
