<?php

declare(strict_types=1);

namespace Tests\Tickets\Prices\Policies;

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use TicketPriceModeling\Customers\Types\Type;
use TicketPriceModeling\Tickets\Prices\Policies\HolidayPolicy;
use TicketPriceModeling\Tickets\Prices\Price;

class HolidayPolicyTest extends TestCase
{
    private HolidayPolicy $policy;

    public function setUp(): void
    {
        $this->policy = new HolidayPolicy();
    }

    #[Test]
    public function 顧客区分が一般の場合はチケット料金1800円が返る(): void
    {
        $price = $this->policy->price(Type::General);
        $this->assertTrue((new Price(1800))->equals($price));
    }

    #[Test]
    public function 顧客区分が大学生の場合はチケット料金1500円が返る(): void
    {
        $price = $this->policy->price(Type::UniversityStudent);
        $this->assertTrue((new Price(1500))->equals($price));
    }

    #[Test]
    public function 顧客区分が専門学生の場合はチケット料金1500円が返る(): void
    {
        $price = $this->policy->price(Type::ProfessionalStudent);
        $this->assertTrue((new Price(1500))->equals($price));
    }

    #[Test]
    public function 顧客区分がシネマシティズンの場合はチケット料金1300円が返る(): void
    {
        $price = $this->policy->price(Type::CinemaCitizen);
        $this->assertTrue((new Price(1300))->equals($price));
    }

    #[Test]
    public function 顧客区分がシニアの場合はチケット料金1100円が返る(): void
    {
        $price = $this->policy->price(Type::Senior);
        $this->assertTrue((new Price(1100))->equals($price));
    }

    #[Test]
    public function 顧客区分が障がい者の場合はチケット料金900円が返る(): void
    {
        $price = $this->policy->price(Type::Disability);
        $this->assertTrue((new Price(900))->equals($price));
    }

    public static function otherTypeDataProvider(): array
    {
        return [
            [Type::CinemaCitizenSenior, 'シネマシティズンシニア'],
            [Type::HighSchoolStudent, '高校生'],
            [Type::MiddleSchoolStudent, '中学生'],
            [Type::Child, '小人'],
        ];
    }

    #[DataProvider('otherTypeDataProvider')]
    #[Test]
    public function 顧客区分が上記以外の場合はチケット料金1000円が返る(Type $type, string $message): void
    {
        $price = $this->policy->price($type);
        $this->assertTrue((new Price(1000))->equals($price), $message);
    }
}
