<?php

declare(strict_types=1);

namespace Tests\Customer\Type\Specification;

use PHPUnit\Framework\TestCase;
use TicketPriceModeling\Customer\Age;
use TicketPriceModeling\Customer\Certificate;
use TicketPriceModeling\Customer\Person;
use TicketPriceModeling\Customer\Type\Specification\DisabilitySpecification;

class DisabilitySpecificationTest extends TestCase
{
    /**
     * @param Certificate[] $certificates
     */
    private function factoryCustomerPerson(array $certificates): Person {
        return new Person(new Age(20), $certificates);
    }

    /**
     * @test
     */
    public function 顧客が障がい者証明書を持っているならtrueを返す(): void
    {
        // Arrange
        $sut = new DisabilitySpecification();
        $customer = $this->factoryCustomerPerson([Certificate::Disability]);

        // Act & Assert
        $this->assertTrue($sut->isSatisfiedBy($customer));
    }

    /**
     * @test
     */
    public function 顧客が障がい者証明書を持っていないならfalseを返す(): void
    {
        // Arrange
        $sut = new DisabilitySpecification();
        $customer = $this->factoryCustomerPerson([]);

        // Act & Assert
        $this->assertFalse($sut->isSatisfiedBy($customer));
    }
}
