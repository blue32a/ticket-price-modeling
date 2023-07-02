<?php

declare(strict_types=1);

namespace Tests\Customers\Types\Specifications;

use PHPUnit\Framework\TestCase;
use TicketPriceModeling\Customers\Age;
use TicketPriceModeling\Customers\Certificate;
use TicketPriceModeling\Customers\Customer;
use TicketPriceModeling\Customers\Types\Specifications\CinemaCitizenSeniorSpecification;

class CinemaCitizenSeniorSpecificationTest extends TestCase
{
    /**
     * @param Certificate[] $certificates
     */
    private function customerFacotry(Age $age, array $certificates): Customer {
        return new Customer($age, $certificates);
    }

    /**
     * @test
     */
    public function 顧客がシネマシティズン証明書を持っていて、かつ年齢が60歳以上の場合はtrueを返す(): void
    {
        // Arrange
        $sut = new CinemaCitizenSeniorSpecification();
        $customer = $this->customerFacotry(new Age(60), [Certificate::CinemaCitizen]);

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
        $customer = $this->customerFacotry(new Age(60), []);

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
        $customer = $this->customerFacotry(new Age(59), [Certificate::CinemaCitizen]);

        // Act & Assert
        $this->assertFalse($sut->isSatisfiedBy($customer));
    }
}
