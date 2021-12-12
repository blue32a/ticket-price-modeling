<?php

declare(strict_types=1);

namespace Tests\Tickets\Prices;

use DomainException;
use PHPUnit\Framework\TestCase;
use TicketPriceModeling\Tickets\Prices\Price;

class PriceTest extends TestCase
{
    /**
     * @test
     */
    public function チケット料金は0円以下ではない(): void
    {
        $this->expectException(DomainException::class);
        new Price(0);
    }

    /**
     * @test
     */
    public function valueはチケット料金の値を取得できる(): void
    {
        $price = new Price(1000);
        $this->assertEquals(1000, $price->value());
    }

    /**
     * @test
     */
    public function equalsは等価比較ができる(): void
    {
        $this->assertTrue((new Price(1000))->equals(new Price(1000)));
        $this->assertFalse((new Price(1200))->equals(new Price(1300)));
    }
}
