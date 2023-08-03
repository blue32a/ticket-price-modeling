<?php

declare(strict_types=1);

namespace Tests\Purchase;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use TicketPriceModeling\Customer\Type\Type as CustomerType;
use TicketPriceModeling\Purchase\BasePricePolicy;
use TicketPriceModeling\Screening\ShowTime\Type as ShowTimeType;

class BasePricePolicyTest extends TestCase
{
    #[DataProvider('priceDataProvider')]
    #[Test]
    public function 上映開始日時と顧客情報からチケット料金を計算する(
        CustomerType $customerType,
        ShowTimeType $showTimeType,
        int $expected
    ): void {
        // Arrange
        $sut = new BasePricePolicy();

        // Act
        $price = $sut->get($customerType, $showTimeType);

        // Assert
        $this->assertSame($expected, $price->value());
    }

    public static function priceDataProvider(): array
    {
        return [
            'シネマシティズン、平日通常時間上映' => [
                CustomerType::CinemaCitizen,
                ShowTimeType::WeekdayEarly,
                1000,
            ],
            'シネマシティズン、平日レイト上映' => [
                CustomerType::CinemaCitizen,
                ShowTimeType::WeekdayLate,
                1000,
            ],
            'シネマシティズン、休日通常時間上映' => [
                CustomerType::CinemaCitizen,
                ShowTimeType::HolidayEarly,
                1300,
            ],
            'シネマシティズン、休日レイト上映' => [
                CustomerType::CinemaCitizen,
                ShowTimeType::HolidayLate,
                1000,
            ],
            'シネマシティズン、映画の日上映' => [
                CustomerType::CinemaCitizen,
                ShowTimeType::CinemaAnniversary,
                1100,
            ],

            'シネマシティズン（60才以上）、平日通常時間上映' => [
                CustomerType::CinemaCitizenSenior,
                ShowTimeType::WeekdayEarly,
                1000,
            ],
            'シネマシティズン（60才以上）、平日レイト上映' => [
                CustomerType::CinemaCitizenSenior,
                ShowTimeType::WeekdayLate,
                1000,
            ],
            'シネマシティズン（60才以上）、休日通常時間上映' => [
                CustomerType::CinemaCitizenSenior,
                ShowTimeType::HolidayEarly,
                1000,
            ],
            'シネマシティズン（60才以上）、休日レイト上映' => [
                CustomerType::CinemaCitizenSenior,
                ShowTimeType::HolidayLate,
                1000,
            ],
            'シネマシティズン（60才以上）、映画の日上映' => [
                CustomerType::CinemaCitizenSenior,
                ShowTimeType::CinemaAnniversary,
                1000,
            ],

            '一般、平日通常時間上映' => [
                CustomerType::General,
                ShowTimeType::WeekdayEarly,
                1800,
            ],
            '一般、平日レイト上映' => [
                CustomerType::General,
                ShowTimeType::WeekdayLate,
                1300,
            ],
            '一般、休日通常時間上映' => [
                CustomerType::General,
                ShowTimeType::HolidayEarly,
                1800,
            ],
            '一般、休日レイト上映' => [
                CustomerType::General,
                ShowTimeType::HolidayLate,
                1300,
            ],
            '一般、映画の日上映' => [
                CustomerType::General,
                ShowTimeType::CinemaAnniversary,
                1100,
            ],

            'シニア（70才以上）、平日通常時間上映' => [
                CustomerType::Senior,
                ShowTimeType::WeekdayEarly,
                1100,
            ],
            'シニア（70才以上）、平日レイト上映' => [
                CustomerType::Senior,
                ShowTimeType::WeekdayLate,
                1100,
            ],
            'シニア（70才以上）、休日通常時間上映' => [
                CustomerType::Senior,
                ShowTimeType::HolidayEarly,
                1100,
            ],
            'シニア（70才以上）、休日レイト上映' => [
                CustomerType::Senior,
                ShowTimeType::HolidayLate,
                1100,
            ],
            'シニア（70才以上）、映画の日上映' => [
                CustomerType::Senior,
                ShowTimeType::CinemaAnniversary,
                1100,
            ],

            '大学生、平日通常時間上映' => [
                CustomerType::UniversityStudent,
                ShowTimeType::WeekdayEarly,
                1500,
            ],
            '大学生、平日レイト上映' => [
                CustomerType::UniversityStudent,
                ShowTimeType::WeekdayLate,
                1300,
            ],
            '大学生、休日通常時間上映' => [
                CustomerType::UniversityStudent,
                ShowTimeType::HolidayEarly,
                1500,
            ],
            '大学生、休日レイト上映' => [
                CustomerType::UniversityStudent,
                ShowTimeType::HolidayLate,
                1300,
            ],
            '大学生、映画の日上映' => [
                CustomerType::UniversityStudent,
                ShowTimeType::CinemaAnniversary,
                1100,
            ],

            '専門学生、平日通常時間上映' => [
                CustomerType::ProfessionalStudent,
                ShowTimeType::WeekdayEarly,
                1500,
            ],
            '専門学生、平日レイト上映' => [
                CustomerType::ProfessionalStudent,
                ShowTimeType::WeekdayLate,
                1300,
            ],
            '専門学生、休日通常時間上映' => [
                CustomerType::ProfessionalStudent,
                ShowTimeType::HolidayEarly,
                1500,
            ],
            '専門学生、休日レイト上映' => [
                CustomerType::ProfessionalStudent,
                ShowTimeType::HolidayLate,
                1300,
            ],
            '専門学生、映画の日上映' => [
                CustomerType::ProfessionalStudent,
                ShowTimeType::CinemaAnniversary,
                1100,
            ],

            '高校生、平日通常時間上映' => [
                CustomerType::HighSchoolStudent,
                ShowTimeType::WeekdayEarly,
                1000,
            ],
            '高校生、平日レイト上映' => [
                CustomerType::HighSchoolStudent,
                ShowTimeType::WeekdayLate,
                1000,
            ],
            '高校生、休日通常時間上映' => [
                CustomerType::HighSchoolStudent,
                ShowTimeType::HolidayEarly,
                1000,
            ],
            '高校生、休日レイト上映' => [
                CustomerType::HighSchoolStudent,
                ShowTimeType::HolidayLate,
                1000,
            ],
            '高校生、映画の日上映' => [
                CustomerType::HighSchoolStudent,
                ShowTimeType::CinemaAnniversary,
                1000,
            ],

            '中学生、平日通常時間上映' => [
                CustomerType::MiddleSchoolStudent,
                ShowTimeType::WeekdayEarly,
                1000,
            ],
            '中学生、平日レイト上映' => [
                CustomerType::MiddleSchoolStudent,
                ShowTimeType::WeekdayLate,
                1000,
            ],
            '中学生、休日通常時間上映' => [
                CustomerType::MiddleSchoolStudent,
                ShowTimeType::HolidayEarly,
                1000,
            ],
            '中学生、休日レイト上映' => [
                CustomerType::MiddleSchoolStudent,
                ShowTimeType::HolidayLate,
                1000,
            ],
            '中学生、映画の日上映' => [
                CustomerType::MiddleSchoolStudent,
                ShowTimeType::CinemaAnniversary,
                1000,
            ],

            '小人、平日通常時間上映' => [
                CustomerType::Child,
                ShowTimeType::WeekdayEarly,
                1000,
            ],
            '小人、平日レイト上映' => [
                CustomerType::Child,
                ShowTimeType::WeekdayLate,
                1000,
            ],
            '小人、休日通常時間上映' => [
                CustomerType::Child,
                ShowTimeType::HolidayEarly,
                1000,
            ],
            '小人、休日レイト上映' => [
                CustomerType::Child,
                ShowTimeType::HolidayLate,
                1000,
            ],
            '小人、映画の日上映' => [
                CustomerType::Child,
                ShowTimeType::CinemaAnniversary,
                1000,
            ],
        ];
    }
}
