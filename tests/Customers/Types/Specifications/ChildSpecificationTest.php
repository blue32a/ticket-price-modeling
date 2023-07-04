<?php

declare(strict_types=1);

namespace Tests\Customers\Types\Specifications;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use TicketPriceModeling\Customers\Age;
use TicketPriceModeling\Customers\Customer;
use TicketPriceModeling\Customers\Types\Specifications\ChildSpecification;

class ChildSpecificationTest extends TestCase
{
    private function customerFacotry(Age $age): Customer
    {
        return new Customer($age, []);
    }

    #[Test]
    public function 顧客の年齢が12歳以下ならtrueを返す(): void
    {
        // Arrange
        $customer = $this->customerFacotry(new Age(12));
        $sut = new ChildSpecification();

        // Act & Assert
        $this->assertTrue($sut->isSatisfiedBy($customer));
    }

    #[Test]
    public function 顧客の年齢が12歳より大きいならfalseを返す(): void
    {
        // Arrange
        $customer = $this->customerFacotry(new Age(13));
        $sut = new ChildSpecification();

        // Act & Assert
        $this->assertFalse($sut->isSatisfiedBy($customer));
    }
}
