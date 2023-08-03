<?php

declare(strict_types=1);

namespace Tests\Customer\Type\Specification;

use PHPUnit\Framework\TestCase;
use TicketPriceModeling\Customer\Age;
use TicketPriceModeling\Customer\Certificate;
use TicketPriceModeling\Customer\Person;
use TicketPriceModeling\Customer\Type\Specification\CinemaCitizenSeniorSpecification;

class CinemaCitizenSeniorSpecificationTest extends TestCase
{
    /**
     * @param Certificate[] $certificates
     */
    private function factoryCustomerPerson(Age $age, array $certificates): Person {
        return new Person($age, $certificates);
    }

    /**
     * @test
     */
    public function 顧客がシネマシティズン証明書を持っていて、かつ年齢が60歳以上の場合はtrueを返す(): void
    {
        // Arrange
        $sut = new CinemaCitizenSeniorSpecification();
        $customer = $this->factoryCustomerPerson(new Age(60), [Certificate::CinemaCitizen]);

        // Act & Assert
        $this->assertTrue($sut->isSatisfiedBy($customer));
    }

    /**
     * @test
     */
    public function 顧客がシネマシティズン証明書を持っていない、かつ年齢が60歳以上の場合はfalseを返す(): void
    {
        // Arrange
        $sut = new CinemaCitizenSeniorSpecification();
        $customer = $this->factoryCustomerPerson(new Age(60), []);

        // Act & Assert
        $this->assertFalse($sut->isSatisfiedBy($customer));
    }

    /**
     * @test
     */
    public function 顧客がシネマシティズン証明書を持っていて、かつ年齢が60歳未満の場合はfalseを返す(): void
    {
        // Arrange
        $sut = new CinemaCitizenSeniorSpecification();
        $customer = $this->factoryCustomerPerson(new Age(59), [Certificate::CinemaCitizen]);

        // Act & Assert
        $this->assertFalse($sut->isSatisfiedBy($customer));
    }
}
