<?php

declare(strict_types=1);

namespace Tests\Customers;

use PHPUnit\Framework\TestCase;
use TicketPriceModeling\Customers\Age;
use TicketPriceModeling\Customers\Customer;
use TicketPriceModeling\Customers\Certificate\CitizenMemberCertificate;
use TicketPriceModeling\Customers\Certificate\DisabilityCertificate;
use TicketPriceModeling\Customers\Certificate\IdentificationCertificate;
use TicketPriceModeling\Customers\Certificate\MiddleSchoolStudentCetficate;
use TicketPriceModeling\Customers\Certificate\StudentCertificate;

class CustomerTest extends TestCase
{
    private function customerFacotry(
        ?Age $age = null,
        ?IdentificationCertificate $identificationCertificate = null,
        ?CitizenMemberCertificate $citizenMemberCertificate = null,
        ?StudentCertificate $studentCertificate = null,
        ?DisabilityCertificate $disabilityCertificate = null
    ): Customer {
        $age ??= new Age(32);
        return new Customer(
            $age,
            $identificationCertificate,
            $citizenMemberCertificate,
            $studentCertificate,
            $disabilityCertificate
        );
    }

    /**
     * @test
     */
    public function ageは顧客の年齢を返す(): void
    {
        $customer = $this->customerFacotry(new Age(21));
        $this->assertTrue((new Age(21))->equals($customer->age()));
    }

    /**
     * @test
     */
    public function identificationCertificateは顧客の身分証明書を返す(): void
    {
        $identificationCertificate = new IdentificationCertificate();
        $hasCertificateCustomer = $this->customerFacotry(null, $identificationCertificate);
        $this->assertEquals($identificationCertificate, $hasCertificateCustomer->identificationCertificate());

        $doNotHasCertificateCustomer = $this->customerFacotry(null, null);
        $this->assertNull($doNotHasCertificateCustomer->identificationCertificate());
    }

    /**
     * @test
     */
    public function citizenMemberCertificateは顧客のシネマシティズン会員証明を返す(): void
    {
        $citizenMembercertificate = new CitizenMemberCertificate();
        $hasCertificateCustomer = $this->customerFacotry(null, null, $citizenMembercertificate);
        $this->assertEquals($citizenMembercertificate, $hasCertificateCustomer->citizenMemberCertificate());

        $doNotHasCertificateCustomer = $this->customerFacotry(null, null, null);
        $this->assertNull($doNotHasCertificateCustomer->citizenMemberCertificate());
    }

    /**
     * @test
     */
    public function studentCertificateは顧客の学生証明書を返す(): void
    {
        $studentCetficate = new MiddleSchoolStudentCetficate();
        $hasCertificateCustomer = $this->customerFacotry(null, null, null, $studentCetficate);
        $this->assertEquals($studentCetficate, $hasCertificateCustomer->studentCertificate());

        $doNotHasCertificateCustomer = $this->customerFacotry(null, null, null, null);
        $this->assertNull($doNotHasCertificateCustomer->studentCertificate());
    }

    /**
     * @test
     */
    public function disabilityCertificateは顧客の障害証明書を返す(): void
    {
        $disabilitycertificate = new DisabilityCertificate();
        $hasCertificateCustomer = $this->customerFacotry(null, null, null, null, $disabilitycertificate);
        $this->assertEquals($disabilitycertificate, $hasCertificateCustomer->disabilityCertificate());

        $doNotHasCertificateCustomer = $this->customerFacotry(null, null, null, null, null);
        $this->assertNull($doNotHasCertificateCustomer->disabilityCertificate());
    }
}
