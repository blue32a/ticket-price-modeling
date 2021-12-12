<?php

declare(strict_types=1);

namespace Tests\Customers;

use DomainException;
use PHPUnit\Framework\TestCase;
use TicketPriceModeling\Customers\Age;

class AgeTest extends TestCase
{
    /**
     * @test
     */
    public function 顧客年齢は3歳未満ではない(): void
    {
        $this->expectException(DomainException::class);
        new Age(2);
    }

    /**
     * @test
     */
    public function valueは顧客年齢の値を取得できる(): void
    {
        $age = new Age(32);
        $this->assertEquals(32, $age->value());
    }

    /**
     * @test
     */
    public function equalsは等価比較ができる(): void
    {
        $this->assertTrue((new Age(10))->equals(new Age(10)));
        $this->assertFalse((new Age(21))->equals(new Age(22)));
    }

    /**
     * @test
     */
    public function greaterThanOrEqualは引数age以上の場合にtrueを返す(): void
    {
        $this->assertTrue((new Age(20))->greaterThanOrEqual(new Age(19)));
        $this->assertTrue((new Age(20))->greaterThanOrEqual(new Age(20)));
    }

    /**
     * @test
     */
    public function greaterThanOrEqualは引数ageより小さい場合にfalseを返す(): void
    {
        $this->assertFalse((new Age(20))->greaterThanOrEqual(new Age(21)));
    }

    /**
     * @test
     */
    public function lessThanOrEqualは引数age以下の場合にtrueを返す(): void
    {
        $this->assertTrue((new Age(20))->lessThanOrEqual(new Age(21)));
        $this->assertTrue((new Age(20))->lessThanOrEqual(new Age(20)));
    }

    /**
     * @test
     */
    public function lessThanOrEqualは引数ageより大きい場合にfalseを返す(): void
    {
        $this->assertFalse((new Age(20))->lessThanOrEqual(new Age(19)));
    }
}
