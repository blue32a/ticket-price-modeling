<?php

declare(strict_types=1);

namespace Tests\Customers\Types\Specifications;

use PHPUnit\Framework\TestCase;
use TicketPriceModeling\Customers\Age;
use TicketPriceModeling\Customers\Certificate;
use TicketPriceModeling\Customers\Customer;
use TicketPriceModeling\Customers\Types\Specifications\DisabilitySpecification;

class DisabilitySpecificationTest extends TestCase
{
    /**
     * @param Certificate[] $certificates
     */
    private function customerFacotry(array $certificates): Customer {
        return new Customer(new Age(20), $certificates);
    }

    /**
     * @test
     */
    public function 顧客が障がい者証明書を持っているならtrueを返す(): void
    {
        // Arrange
        $sut = new DisabilitySpecification();
        $customer = $this->customerFacotry([Certificate::Disability]);

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
        $customer = $this->customerFacotry([]);

        // Act & Assert
        $this->assertFalse($sut->isSatisfiedBy($customer));
    }
}
