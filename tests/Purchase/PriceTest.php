<?php

declare(strict_types=1);

namespace Tests\Purchase;

use InvalidArgumentException;
use PHPUnit\Framework\TestCase;
use TicketPriceModeling\Purchase\Price;

class PriceTest extends TestCase
{
    /**
     * @test
     */
    public function チケット料金は0円以下ではない(): void
    {
        $this->expectException(InvalidArgumentException::class);
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
