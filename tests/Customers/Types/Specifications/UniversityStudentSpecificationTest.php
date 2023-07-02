<?php

declare(strict_types=1);

namespace Tests\Customers\Types\Specifications;

use PHPUnit\Framework\TestCase;
use TicketPriceModeling\Customers\Age;
use TicketPriceModeling\Customers\Certificate;
use TicketPriceModeling\Customers\Customer;
use TicketPriceModeling\Customers\Types\Specifications\UniversityStudentSpecification;

class UniversityStudentSpecificationTest extends TestCase
{
    /**
     * @param Certificate[] $certificates
     */
    private function customerFacotry(array $certificates): Customer
    {
        return new Customer(new Age(13), $certificates);
    }

    /**
     * @test
     */
    public function 顧客が大学の学生証明書を持っていたらtrueを返す(): void
    {
        // Arrange
        $sut = new UniversityStudentSpecification();
        $customer = $this->customerFacotry([Certificate::UniversityStudent]);

        // Act & Assert
        $this->assertTrue($sut->isSatisfiedBy($customer));
    }

    /**
     * @test
     */
    public function 顧客が大学の学生証明書を持っていなければfalseを返す(): void
    {
        // Arrange
        $sut = new UniversityStudentSpecification();
        $customer = $this->customerFacotry([]);

        // Act & Assert
        $this->assertFalse($sut->isSatisfiedBy($customer));
    }
}
