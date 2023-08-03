<?php

declare(strict_types=1);

namespace Tests\Purchase;

use DateTimeImmutable;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use TicketPriceModeling\Customer\Age;
use TicketPriceModeling\Customer\Certificate;
use TicketPriceModeling\Customer\Person;
use TicketPriceModeling\Purchase\PriceCalculator;
use TicketPriceModeling\Screening\ShowTime\StartAt;

class PriceCalculatorTest extends TestCase
{
    #[Test]
    public function 顧客と上映開始時間の組み合わせから料金を計算する(): void
    {
        // Arrange
        $customerPerson = $this->factory一般客();
        $startAt = $this->factory平日通常時間の上映開始時間();
        $sut = new PriceCalculator();

        // Act
        $price = $sut->calculate($customerPerson, $startAt);

        // Assert
        $this->assertSame(1800, $price->value());
    }

    #[Test]
    public function 料金は顧客の状況に当てはまるものから最も安い料金になる(): void
    {
        // Arrange
        $customerPerson = $this->factory中学生で障害者の顧客();
        $startAt = $this->factory平日通常時間の上映開始時間();
        $sut = new PriceCalculator();

        // Act
        $price = $sut->calculate($customerPerson, $startAt);

        // Assert
        $this->assertNotSame(1000, $price->value()); // 中・高校生料金
        $this->assertSame(900, $price->value()); // 障がい者料金
    }

    private function factory平日通常時間の上映開始時間(): StartAt
    {
        return new StartAt(new DateTimeImmutable('2023-07-03 10:00:00'));
    }


    private function factory一般客(): Person
    {
        return new Person(new Age(20));
    }

    private function factory中学生で障害者の顧客(): Person
    {
        return new Person(new Age(16), [
            Certificate::MiddleSchoolStudent,
            Certificate::Disability,
        ]);
    }
}
