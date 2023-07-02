<?php

declare(strict_types=1);

namespace Tests\Tickets\Prices\Policies;

use PHPUnit\Framework\TestCase;
use TicketPriceModeling\Customers\Types\Child;
use TicketPriceModeling\Customers\Types\CinemaCitizen;
use TicketPriceModeling\Customers\Types\CinemaCitizenSenior;
use TicketPriceModeling\Customers\Types\Disability;
use TicketPriceModeling\Customers\Types\General;
use TicketPriceModeling\Customers\Types\HighSchoolStudent;
use TicketPriceModeling\Customers\Types\MiddleSchoolStudent;
use TicketPriceModeling\Customers\Types\ProfessionalStudent;
use TicketPriceModeling\Customers\Types\Senior;
use TicketPriceModeling\Customers\Types\Type;
use TicketPriceModeling\Customers\Types\UniversityStudent;
use TicketPriceModeling\Tickets\Prices\Policies\CinemaAnniversaryPolicy;
use TicketPriceModeling\Tickets\Prices\Price;

class CinemaAnniversaryPolicyTest extends TestCase
{
    private CinemaAnniversaryPolicy $policy;

    public function setUp(): void
    {
        $this->policy = new CinemaAnniversaryPolicy();
    }

    /**
     * @test
     */
    public function 顧客区分がシネマシティズンで、上映開始日時が休日の場合はチケット料金1100円が返る(): void
    {
        $price = $this->policy->price(new CinemaCitizen());
        $this->assertTrue((new Price(1100))->equals($price));
    }

    /**
     * @test
     */
    public function 顧客区分が一般の場合はチケット料金1100円が返る(): void
    {
        $price = $this->policy->price(new General());
        $this->assertTrue((new Price(1100))->equals($price));
    }

    /**
     * @test
     */
    public function 顧客区分が大学生の場合はチケット料金1100円が返る(): void
    {
        $price = $this->policy->price(new UniversityStudent());
        $this->assertTrue((new Price(1100))->equals($price));
    }

    /**
     * @test
     */
    public function 顧客区分が専門学生の場合はチケット料金1100円が返る(): void
    {
        $price = $this->policy->price(new ProfessionalStudent());
        $this->assertTrue((new Price(1100))->equals($price));
    }

    /**
     * @test
     */
    public function 顧客区分がシニアの場合はチケット料金1100円が返る(): void
    {
        $price = $this->policy->price(new Senior());
        $this->assertTrue((new Price(1100))->equals($price));
    }

    /**
     * @test
     */
    public function 顧客区分が障がい者の場合はチケット料金900円が返る(): void
    {
        $price = $this->policy->price(new Disability());
        $this->assertTrue((new Price(900))->equals($price));
    }

    public static function otherTypeDataProvider(): array
    {
        return [
            [new CinemaCitizenSenior(), 'シネマシティズンシニア'],
            [new HighSchoolStudent(), '高校生'],
            [new MiddleSchoolStudent(), '中学生'],
            [new Child(), '小人'],
        ];
    }

    /**
     * @dataProvider otherTypeDataProvider
     * @test
     */
    public function 顧客区分が上記以外の場合はチケット料金1000円が返る(Type $type, string $message): void
    {
        $price = $this->policy->price($type);
        $this->assertTrue((new Price(1000))->equals($price), $message);
    }
}
