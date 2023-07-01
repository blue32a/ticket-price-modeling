<?php

declare(strict_types=1);

namespace Tests\Tickets\Service;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use TicketPriceModeling\Customers\Age;
use TicketPriceModeling\Customers\Certificate\CitizenMemberCertificate;
use TicketPriceModeling\Customers\Certificate\HighSchoolStudentCertificate;
use TicketPriceModeling\Customers\Certificate\IdentificationCertificate;
use TicketPriceModeling\Customers\Certificate\MiddleSchoolStudentCetficate;
use TicketPriceModeling\Customers\Certificate\ProfessionalStudentCertificate;
use TicketPriceModeling\Customers\Certificate\UniversityStudentCertificate;
use TicketPriceModeling\Customers\Customer;
use TicketPriceModeling\Schedules\PlayStartDateTime;
use TicketPriceModeling\Tickets\Service\PriceCalculation as Sut;

class PriceCalculationTest extends TestCase
{
    #[DataProvider('calculationDataProvider')]
    #[Test]
    public function 上映開始日時と顧客情報からチケット料金を計算する(
        PlayStartDateTime $playStartDateTime,
        Customer $customer,
        int $expected
    ): void {
        $price = Sut::caluculation($playStartDateTime, $customer);

        $this->assertSame($expected, $price->value());
    }

    public static function calculationDataProvider(): array
    {
        return [
            'シネマシティズン、平日通常時間上映' => [
                self::factoryPlayStartWeekdayNotLateShow(),
                self::factoryCustomerCitizenMember(),
                1000,
            ],
            'シネマシティズン、平日レイト上映' => [
                self::factoryPlayStartWeekdayLateShow(),
                self::factoryCustomerCitizenMember(),
                1000,
            ],
            'シネマシティズン、休日通常時間上映' => [
                self::factoryPlayStartHolidayNotLateShow(),
                self::factoryCustomerCitizenMember(),
                1300,
            ],
            'シネマシティズン、休日レイト上映' => [
                self::factoryPlayStartHolidayLateShow(),
                self::factoryCustomerCitizenMember(),
                1000,
            ],
            'シネマシティズン、映画の日上映' => [
                self::factoryPlayStartCinemaAnniversary(),
                self::factoryCustomerCitizenMember(),
                1100,
            ],

            'シネマシティズン（60才以上）、平日通常時間上映' => [
                self::factoryPlayStartWeekdayNotLateShow(),
                self::factoryCustomerCitizenMemberSenior(),
                1000,
            ],
            'シネマシティズン（60才以上）、平日レイト上映' => [
                self::factoryPlayStartWeekdayLateShow(),
                self::factoryCustomerCitizenMemberSenior(),
                1000,
            ],
            'シネマシティズン（60才以上）、休日通常時間上映' => [
                self::factoryPlayStartHolidayNotLateShow(),
                self::factoryCustomerCitizenMemberSenior(),
                1000,
            ],
            'シネマシティズン（60才以上）、休日レイト上映' => [
                self::factoryPlayStartHolidayLateShow(),
                self::factoryCustomerCitizenMemberSenior(),
                1000,
            ],
            'シネマシティズン（60才以上）、映画の日上映' => [
                self::factoryPlayStartCinemaAnniversary(),
                self::factoryCustomerCitizenMemberSenior(),
                1000,
            ],

            '一般、平日通常時間上映' => [
                self::factoryPlayStartWeekdayNotLateShow(),
                self::factoryCustomerGeneral(),
                1800,
            ],
            '一般、平日レイト上映' => [
                self::factoryPlayStartWeekdayLateShow(),
                self::factoryCustomerGeneral(),
                1300,
            ],
            '一般、休日通常時間上映' => [
                self::factoryPlayStartHolidayNotLateShow(),
                self::factoryCustomerGeneral(),
                1800,
            ],
            '一般、休日レイト上映' => [
                self::factoryPlayStartHolidayLateShow(),
                self::factoryCustomerGeneral(),
                1300,
            ],
            '一般、映画の日上映' => [
                self::factoryPlayStartCinemaAnniversary(),
                self::factoryCustomerGeneral(),
                1100,
            ],

            'シニア（70才以上）、平日通常時間上映' => [
                self::factoryPlayStartWeekdayNotLateShow(),
                self::factoryCustomerSenior(),
                1100,
            ],
            'シニア（70才以上）、平日レイト上映' => [
                self::factoryPlayStartWeekdayLateShow(),
                self::factoryCustomerSenior(),
                1100,
            ],
            'シニア（70才以上）、休日通常時間上映' => [
                self::factoryPlayStartHolidayNotLateShow(),
                self::factoryCustomerSenior(),
                1100,
            ],
            'シニア（70才以上）、休日レイト上映' => [
                self::factoryPlayStartHolidayLateShow(),
                self::factoryCustomerSenior(),
                1100,
            ],
            'シニア（70才以上）、映画の日上映' => [
                self::factoryPlayStartCinemaAnniversary(),
                self::factoryCustomerSenior(),
                1100,
            ],

            '大学生、平日通常時間上映' => [
                self::factoryPlayStartWeekdayNotLateShow(),
                self::factoryCustomerUniversityStudent(),
                1500,
            ],
            '大学生、平日レイト上映' => [
                self::factoryPlayStartWeekdayLateShow(),
                self::factoryCustomerUniversityStudent(),
                1300,
            ],
            '大学生、休日通常時間上映' => [
                self::factoryPlayStartHolidayNotLateShow(),
                self::factoryCustomerUniversityStudent(),
                1500,
            ],
            '大学生、休日レイト上映' => [
                self::factoryPlayStartHolidayLateShow(),
                self::factoryCustomerUniversityStudent(),
                1300,
            ],
            '大学生、映画の日上映' => [
                self::factoryPlayStartCinemaAnniversary(),
                self::factoryCustomerUniversityStudent(),
                1100,
            ],

            '専門学生、平日通常時間上映' => [
                self::factoryPlayStartWeekdayNotLateShow(),
                self::factoryCustomerProfessionalStudent(),
                1500,
            ],
            '専門学生、平日レイト上映' => [
                self::factoryPlayStartWeekdayLateShow(),
                self::factoryCustomerProfessionalStudent(),
                1300,
            ],
            '専門学生、休日通常時間上映' => [
                self::factoryPlayStartHolidayNotLateShow(),
                self::factoryCustomerProfessionalStudent(),
                1500,
            ],
            '専門学生、休日レイト上映' => [
                self::factoryPlayStartHolidayLateShow(),
                self::factoryCustomerProfessionalStudent(),
                1300,
            ],
            '専門学生、映画の日上映' => [
                self::factoryPlayStartCinemaAnniversary(),
                self::factoryCustomerProfessionalStudent(),
                1100,
            ],

            '高校生、平日通常時間上映' => [
                self::factoryPlayStartWeekdayNotLateShow(),
                self::factoryCustomerHighSchoolStudent(),
                1000,
            ],
            '高校生、平日レイト上映' => [
                self::factoryPlayStartWeekdayLateShow(),
                self::factoryCustomerHighSchoolStudent(),
                1000,
            ],
            '高校生、休日通常時間上映' => [
                self::factoryPlayStartHolidayNotLateShow(),
                self::factoryCustomerHighSchoolStudent(),
                1000,
            ],
            '高校生、休日レイト上映' => [
                self::factoryPlayStartHolidayLateShow(),
                self::factoryCustomerHighSchoolStudent(),
                1000,
            ],
            '高校生、映画の日上映' => [
                self::factoryPlayStartCinemaAnniversary(),
                self::factoryCustomerHighSchoolStudent(),
                1000,
            ],

            '中学生、平日通常時間上映' => [
                self::factoryPlayStartWeekdayNotLateShow(),
                self::factoryCustomerMiddleSchoolStudent(),
                1000,
            ],
            '中学生、平日レイト上映' => [
                self::factoryPlayStartWeekdayLateShow(),
                self::factoryCustomerMiddleSchoolStudent(),
                1000,
            ],
            '中学生、休日通常時間上映' => [
                self::factoryPlayStartHolidayNotLateShow(),
                self::factoryCustomerMiddleSchoolStudent(),
                1000,
            ],
            '中学生、休日レイト上映' => [
                self::factoryPlayStartHolidayLateShow(),
                self::factoryCustomerMiddleSchoolStudent(),
                1000,
            ],
            '中学生、映画の日上映' => [
                self::factoryPlayStartCinemaAnniversary(),
                self::factoryCustomerMiddleSchoolStudent(),
                1000,
            ],

            '小人、平日通常時間上映' => [
                self::factoryPlayStartWeekdayNotLateShow(),
                self::factoryCustomerChild(),
                1000,
            ],
            '小人、平日レイト上映' => [
                self::factoryPlayStartWeekdayLateShow(),
                self::factoryCustomerChild(),
                1000,
            ],
            '小人、休日通常時間上映' => [
                self::factoryPlayStartHolidayNotLateShow(),
                self::factoryCustomerChild(),
                1000,
            ],
            '小人、休日レイト上映' => [
                self::factoryPlayStartHolidayLateShow(),
                self::factoryCustomerChild(),
                1000,
            ],
            '小人、映画の日上映' => [
                self::factoryPlayStartCinemaAnniversary(),
                self::factoryCustomerChild(),
                1000,
            ],
        ];
    }

    private static function factoryPlayStartWeekdayNotLateShow(): PlayStartDateTime
    {
        return new PlayStartDateTime('2023-07-03 10:00:00');
    }

    private static function factoryPlayStartWeekdayLateShow(): PlayStartDateTime
    {
        return new PlayStartDateTime('2023-07-03 20:00:00');
    }

    private static function factoryPlayStartHolidayNotLateShow(): PlayStartDateTime
    {
        return new PlayStartDateTime('2023-07-08 10:00:00');
    }

    private static function factoryPlayStartHolidayLateShow(): PlayStartDateTime
    {
        return new PlayStartDateTime('2023-07-08 20:00:00');
    }

    private static function factoryPlayStartCinemaAnniversary(): PlayStartDateTime
    {
        return new PlayStartDateTime('2023-07-01 20:00:00');
    }

    private static function factoryCustomerCitizenMember(): Customer
    {
        return new Customer(new Age(20), null, new CitizenMemberCertificate(), null, null);
    }

    private static function factoryCustomerCitizenMemberSenior(): Customer
    {
        return new Customer(new Age(60), null, new CitizenMemberCertificate(), null, null);
    }

    private static function factoryCustomerGeneral(): Customer
    {
        return new Customer(new Age(20), null, null, null, null);
    }

    private static function factoryCustomerSenior(): Customer
    {
        return new Customer(new Age(70), new IdentificationCertificate(), null, null, null);
    }

    private static function factoryCustomerUniversityStudent(): Customer
    {
        return new Customer(new Age(20), null, null, new UniversityStudentCertificate(), null);
    }

    private static function factoryCustomerProfessionalStudent(): Customer
    {
        return new Customer(new Age(20), null, null, new ProfessionalStudentCertificate(), null);
    }

    private static function factoryCustomerHighSchoolStudent(): Customer
    {
        return new Customer(new Age(20), null, null, new HighSchoolStudentCertificate(), null);
    }

    private static function factoryCustomerMiddleSchoolStudent(): Customer
    {
        return new Customer(new Age(20), null, null, new MiddleSchoolStudentCetficate(), null);
    }

    private static function factoryCustomerChild(): Customer
    {
        return new Customer(new Age(5), null, null, null, null);
    }
}
