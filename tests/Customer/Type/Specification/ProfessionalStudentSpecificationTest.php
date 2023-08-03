<?php

declare(strict_types=1);

namespace Tests\Customer\Type\Specification;

use PHPUnit\Framework\TestCase;
use TicketPriceModeling\Customer\Age;
use TicketPriceModeling\Customer\Certificate;
use TicketPriceModeling\Customer\Person;
use TicketPriceModeling\Customer\Type\Specification\ProfessionalStudentSpecification;

class ProfessionalStudentSpecificationTest extends TestCase
{
    /**
     * @param Certificate[] $certificates
     */
    private function factoryCustomerPerson(array $certificates): Person
    {
        return new Person(new Age(13), $certificates);
    }

    /**
     * @test
     */
    public function 顧客が専門学校の学生証明書を持っていたらtrueを返す(): void
    {
        // Arrange
        $sut = new ProfessionalStudentSpecification();
        $customer = $this->factoryCustomerPerson([Certificate::ProfessionalStudent]);

        // Act & Assert
        $this->assertTrue($sut->isSatisfiedBy($customer));
    }

    /**
     * @test
     */
    public function 顧客が専門学校の学生証明書を持っていなければfalseを返す(): void
    {
        // Arrange
        $sut = new ProfessionalStudentSpecification();
        $customer = $this->factoryCustomerPerson([]);

        // Act & Assert
        $this->assertFalse($sut->isSatisfiedBy($customer));
    }
}
