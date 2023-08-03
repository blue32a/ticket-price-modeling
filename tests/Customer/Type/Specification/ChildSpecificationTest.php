<?php

declare(strict_types=1);

namespace Tests\Customer\Type\Specification;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use TicketPriceModeling\Customer\Age;
use TicketPriceModeling\Customer\Person;
use TicketPriceModeling\Customer\Type\Specification\ChildSpecification;

class ChildSpecificationTest extends TestCase
{
    private function factoryCustomerPerson(Age $age): Person
    {
        return new Person($age, []);
    }

    #[Test]
    public function 顧客の年齢が12歳以下ならtrueを返す(): void
    {
        // Arrange
        $customer = $this->factoryCustomerPerson(new Age(12));
        $sut = new ChildSpecification();

        // Act & Assert
        $this->assertTrue($sut->isSatisfiedBy($customer));
    }

    #[Test]
    public function 顧客の年齢が12歳より大きいならfalseを返す(): void
    {
        // Arrange
        $customer = $this->factoryCustomerPerson(new Age(13));
        $sut = new ChildSpecification();

        // Act & Assert
        $this->assertFalse($sut->isSatisfiedBy($customer));
    }
}
