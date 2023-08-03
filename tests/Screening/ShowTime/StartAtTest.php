<?php

declare(strict_types=1);

namespace Tests\Screening\ShowTime;

use DateTimeImmutable;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use TicketPriceModeling\Screening\ShowTime\StartAt;

class StartAtTest extends TestCase
{
    private function facotryStartAt(string $datetime): StartAt
    {

        return new StartAt(new DateTimeImmutable($datetime));
    }

    #[DataProvider('invalidStartAtDataProvider')]
    #[Test]
    public function 開始日時が8時より早い時間ではない場合は例外がスローされる(string $datetime): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->facotryStartAt($datetime);
    }

    public static function invalidStartAtDataProvider(): array
    {
        return [
            '境界値' => ['2023-07-01 07:59:59'],
            '代表値' => ['2023-07-01 07:00:00'],
        ];
    }

    #[DataProvider('weekdayDataProvider')]
    #[Test]
    public function isWeekdayは開始日時が平日の場合にtrueを返す(string $date): void
    {
        $sut = $this->facotryStartAt($date . ' 08:00:00');

        $this->assertTrue($sut->isWeekday());
    }

    #[DataProvider('holidayDataProvider')]
    #[Test]
    public function isWeekdayは開始日時が休日の場合にfalseを返す(string $date): void
    {
        $sut = $this->facotryStartAt($date . ' 08:00:00');

        $this->assertFalse($sut->isWeekDay());
    }

    #[DataProvider('holidayDataProvider')]
    #[Test]
    public function isHolidayは開始日時が休日の場合にtrueを返す(string $date): void
    {
        $sut = $this->facotryStartAt($date . ' 08:00:00');

        $this->assertTrue($sut->isHoliday());
    }

    #[DataProvider('weekDayDataProvider')]
    #[Test]
    public function isHolidayは開始日時が平日の場合にfalseを返す(string $date): void
    {
        $sut = $this->facotryStartAt($date . ' 08:00:00');

        $this->assertFalse($sut->isHoliday());
    }

    public static function weekdayDataProvider(): array
    {
        return [
            '月曜日' => ['2023-07-03'],
            '火曜日' => ['2023-07-04'],
            '水曜日' => ['2023-07-05'],
            '木曜日' => ['2023-07-06'],
            '金曜日' => ['2023-07-07'],
        ];
    }

    public static function holidayDataProvider(): array
    {
        return [
            '土曜日' => ['2023-07-08'],
            '日曜日' => ['2023-07-09'],
        ];
    }

    #[DataProvider('isLateShowDataProvider')]
    #[Test]
    public function isLateShowは開始日時が20時以降の場合にtrueを返す(string $time): void
    {
        $sut = $this->facotryStartAt('2023-07-03 ' . $time);

        $this->assertTrue($sut->isLateShow());
    }

    public static function isLateShowDataProvider(): array
    {
        return [
            '境界値' => ['20:00:00'],
            '代表値' => ['22:00:00'],
        ];
    }

    #[DataProvider('isNotLateShowDataProvider')]
    #[Test]
    public function isLateShowは開始日時が20時より早い時間の場合にfalseを返す(string $time): void
    {
        $sut = $this->facotryStartAt('2023-07-03 ' . $time);

        $this->assertFalse($sut->isLateShow());
    }

    public static function isNotLateShowDataProvider(): array
    {
        return [
            '境界値' => ['19:59:59'],
            '代表値' => ['17:00:00'],
        ];
    }

    #[Test]
    public function isCinemaAnniversaryは開始日時が映画の日の場合にtrueを返す(): void
    {
        $sut = $this->facotryStartAt('2023-07-01 08:00:00');

        $this->assertTrue($sut->isCinemaAnniversary());
    }

    #[DataProvider('notCinemaAnniversaryProvider')]
    #[Test]
    public function isCinemaAnniversaryは映画の日ではない場合にfalseを返す(string $date): void
    {
        $sut = $this->facotryStartAt($date . ' 08:00:00');

        $this->assertFalse($sut->isCinemaAnniversary());
    }

    public static function notCinemaAnniversaryProvider(): array
    {
        return [
            '1日の数日前' => ['2023-06-20'],
            '1日の前日' => ['2023-06-30'],
            '1日の翌日' => ['2021-07-02'],
            '1日の数日後' => ['2021-07-10'],
        ];
    }
}
