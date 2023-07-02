<?php

declare(strict_types=1);

namespace Tests\Customers\Types\Specifications;

use PHPUnit\Framework\TestCase;
use TicketPriceModeling\Customers\Age;
use TicketPriceModeling\Customers\Certificate;
use TicketPriceModeling\Customers\Customer;
use TicketPriceModeling\Customers\Types\Specifications\SeniorSpecification;

class SeniorSpecificationTest extends TestCase
{
    /**
     * @param ?Certificate[] $certificates
     */
    private function customerFacotry(Age $age, array $certificates): Customer {
        return new Customer($age, $certificates);
    }

    /**
     * @test
     */
    public function 顧客の年齢が70歳以上で身分証を持っているならtrueを返す(): void
    {
        // Arrange
        $sut = new SeniorSpecification();
        $customer = $this->customerFacotry(new Age(70), [Certificate::Identification]);

        // Act & Assert
        $this->assertTrue($sut->isSatisfiedBy($customer));
    }

    /**
     * @test
     */
    public function 顧客が身分証を持っていないならfalseを返す(): void
    {
        // Arrange
        $sut = new SeniorSpecification();
        $customer = $this->customerFacotry(new Age(70), []);

        // Act & Assert
        $this->assertFalse($sut->isSatisfiedBy($customer));
    }

    /**
     * @test
     */
    public function 顧客の年齢が70歳未満ならfalseを返す(): void
    {
        // Arrange
        $sut = new SeniorSpecification();
        $customer = $this->customerFacotry(new Age(69), [Certificate::Identification]);

        // Act & Assert
        $this->assertFalse($sut->isSatisfiedBy($customer));
    }
}
