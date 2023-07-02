<?php

declare(strict_types=1);

namespace Tests\Customers;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use TicketPriceModeling\Customers\Age;
use TicketPriceModeling\Customers\Certificate;
use TicketPriceModeling\Customers\Customer;

class CustomerTest extends TestCase
{
    /**
     * @param ?Certificate[] $certificates
     */
    private function customerFacotry(
        ?Age $age = null,
        ?array $certificates = []
    ): Customer {
        $age ??= new Age(32);
        return new Customer(
            $age,
            $certificates
        );
    }

    #[Test]
    public function ageは顧客の年齢を返す(): void
    {
        $customer = $this->customerFacotry(new Age(21));
        $this->assertTrue((new Age(21))->equals($customer->age()));
    }

    #[Test]
    public function hasCertificateメソッドは指定の証明書を持っている場合にtrueを返す(): void
    {
        // Arrange
        $sut = $this->customerFacotry(null, [Certificate::CinemaCitizenMember]);

        // Act & Assert
        $this->assertTrue($sut->hasCertificate(Certificate::CinemaCitizenMember));
    }

    #[Test]
    public function hasCertificateメソッドは指定の証明書を持っていない場合にfalseを返す(): void
    {
        // Arrange
        $sut = $this->customerFacotry(null, [Certificate::Identification]);

        // Act & Assert
        $this->assertFalse($sut->hasCertificate(Certificate::CinemaCitizenMember));
    }
}
