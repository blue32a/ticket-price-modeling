<?php

declare(strict_types=1);

namespace Tests\Customer;

use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use TicketPriceModeling\Customer\Age;
use TicketPriceModeling\Customer\Certificate;
use TicketPriceModeling\Customer\Person;

class PersonTest extends TestCase
{
    /**
     * @param ?Certificate[] $certificates
     */
    private function customerFacotry(
        ?Age $age = null,
        ?array $certificates = []
    ): Person {
        $age ??= new Age(32);
        return new Person(
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
        $sut = $this->customerFacotry(null, [Certificate::CinemaCitizen]);

        // Act & Assert
        $this->assertTrue($sut->hasCertificate(Certificate::CinemaCitizen));
    }

    #[Test]
    public function hasCertificateメソッドは指定の証明書を持っていない場合にfalseを返す(): void
    {
        // Arrange
        $sut = $this->customerFacotry(null, [Certificate::Identification]);

        // Act & Assert
        $this->assertFalse($sut->hasCertificate(Certificate::CinemaCitizen));
    }
}
