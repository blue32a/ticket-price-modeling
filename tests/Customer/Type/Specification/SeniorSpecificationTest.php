<?php

declare(strict_types=1);

namespace Tests\Customer\Type\Specification;

use PHPUnit\Framework\TestCase;
use TicketPriceModeling\Customer\Age;
use TicketPriceModeling\Customer\Certificate;
use TicketPriceModeling\Customer\Person;
use TicketPriceModeling\Customer\Type\Specification\SeniorSpecification;

class SeniorSpecificationTest extends TestCase
{
    /**
     * @param ?Certificate[] $certificates
     */
    private function factoryCustomerPerson(Age $age, array $certificates): Person {
        return new Person($age, $certificates);
    }

    /**
     * @test
     */
    public function 顧客の年齢が70歳以上で身分証を持っているならtrueを返す(): void
    {
        // Arrange
        $sut = new SeniorSpecification();
        $customer = $this->factoryCustomerPerson(new Age(70), [Certificate::Identification]);

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
        $customer = $this->factoryCustomerPerson(new Age(70), []);

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
        $customer = $this->factoryCustomerPerson(new Age(69), [Certificate::Identification]);

        // Act & Assert
        $this->assertFalse($sut->isSatisfiedBy($customer));
    }
}
