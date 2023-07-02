<?php

declare(strict_types=1);

namespace Tests\Customers\Types\Specifications;

use PHPUnit\Framework\TestCase;
use TicketPriceModeling\Customers\Age;
use TicketPriceModeling\Customers\Certificate;
use TicketPriceModeling\Customers\Customer;
use TicketPriceModeling\Customers\Types\Specifications\CitizenMemberSpecification;

class CitizenMemberSpecificationTest extends TestCase
{
    /**
     * @param Certificate[] $certificates
     */
    private function customerFacotry(array $certificates): Customer {
        return new Customer(new Age(32), $certificates);
    }

    /**
     * @test
     */
    public function 顧客がシネマシティズン会員証を持っていればtrueを返す(): void
    {
        // Arrange
        $sut = new CitizenMemberSpecification();
        $customer = $this->customerFacotry([Certificate::CinemaCitizenMember]);

        // Act & Assert
        $this->assertTrue($sut->isSatisfiedBy($customer));
    }

    /**
     * @test
     */
    public function 顧客がシネマシティズン会員証を持っていなければfalseを返す(): void
    {
        // Arrange
        $sut = new CitizenMemberSpecification();
        $customer = $this->customerFacotry([]);

        // Act & Assert
        $this->assertFalse($sut->isSatisfiedBy($customer));
    }
}
