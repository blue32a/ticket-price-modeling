<?php

declare(strict_types=1);

namespace Tests\Screening\ShowTime;

use DateTimeImmutable;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use TicketPriceModeling\Screening\ShowTime\StartAt;
use TicketPriceModeling\Screening\ShowTime\Type as SUT;

class TypeTest extends TestCase
{
    #[DataProvider('cinemaAnniversaryDataProvider')]
    #[Test]
    public function 開始日時が映画の日の場合はCinemaAnniversaryと評価される(StartAt $startAt): void
    {
        $this->assertEquals(SUT::CinemaAnniversary, SUT::evaluate($startAt));
    }

    public static function cinemaAnniversaryDataProvider(): array
    {
        return [
            '休日の映画の日' => [self::factory休日の映画の日の開始時間()],
            '平日の映画の日' => [self::factory平日の映画の日の開始時間()],
        ];
    }

    public static function factory休日の映画の日の開始時間(): StartAt
    {
        return new StartAt(new DateTimeImmutable('2023-07-01 08:00:00'));
    }

    public static function factory平日の映画の日の開始時間(): StartAt
    {
        return new StartAt(new DateTimeImmutable('2023-08-01 08:00:00'));
    }

    #[Test]
    public function 開始日時が映画の日以外の休日レイトショーの場合はHolidayLateと評価される(): void
    {
        $startAt = $this->factory映画の日以外の休日レイトショーの開始時間();

        $this->assertEquals(SUT::HolidayLate, SUT::evaluate($startAt));
    }

    #[Test]
    public function 開始日時が映画の日以外の休日通常時間の場合はHolidayEarlyと評価される(): void
    {
        $startAt = $this->factory映画の日以外の休日通常時間の開始時間();

        $this->assertEquals(SUT::HolidayEarly, SUT::evaluate($startAt));
    }

    #[Test]
    public function 開始日時が映画の日以外の平日レイトショーの場合はWeekdayLateと評価される(): void
    {
        $startAt = $this->factory映画の日以外の平日レイトショーの開始時間();

        $this->assertEquals(SUT::WeekdayLate, SUT::evaluate($startAt));
    }

    #[Test]
    public function 開始日時が映画の日以外の平日通常時間の場合はWeekdayEarlyと評価される(): void
    {
        $startAt = $this->factory映画の日以外の平日通常時間の開始時間();

        $this->assertEquals(SUT::WeekdayEarly, SUT::evaluate($startAt));
    }

    private function factory映画の日以外の休日レイトショーの開始時間(): StartAt
    {
        return new StartAt(new DateTimeImmutable('2023-07-02 20:00:00'));
    }

    private function factory映画の日以外の休日通常時間の開始時間(): StartAt
    {
        return new StartAt(new DateTimeImmutable('2023-07-02 08:00:00'));
    }

    private function factory映画の日以外の平日レイトショーの開始時間(): StartAt
    {
        return new StartAt(new DateTimeImmutable('2023-07-03 20:00:00'));
    }

    private function factory映画の日以外の平日通常時間の開始時間(): StartAt
    {
        return new StartAt(new DateTimeImmutable('2023-07-03 08:00:00'));
    }
}
