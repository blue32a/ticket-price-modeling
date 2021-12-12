<?php

declare(strict_types=1);

namespace Tests\Customers\Types\Specifications;

use PHPUnit\Framework\TestCase;
use TicketPriceModeling\Customers\Age;
use TicketPriceModeling\Customers\Customer;
use TicketPriceModeling\Customers\Certificate\IdentificationCertificate;
use TicketPriceModeling\Customers\Types\Specifications\SeniorSpecification;

class SeniorSpecificationTest extends TestCase
{
    private SeniorSpecification $specification;

    private function customerFacotry(
        Age $age,
        ?IdentificationCertificate $identificationCertificate
    ): Customer {
        return new Customer($age, $identificationCertificate, null, null, null);
    }

    public function setUp(): void
    {
        $this->specification = new SeniorSpecification();
    }

    /**
     * @test
     */
    public function 顧客の年齢が70歳以上で身分証を持っているならtrueを返す(): void
    {
        $customer = $this->customerFacotry(new Age(70), new IdentificationCertificate());
        $this->assertTrue($this->specification->isSatisfiedBy($customer));
    }

    /**
     * @test
     */
    public function 顧客が身分証を持っていないならfalseを返す(): void
    {
        $customer = $this->customerFacotry(new Age(70), null);
        $this->assertFalse($this->specification->isSatisfiedBy($customer));
    }

    /**
     * @test
     */
    public function 顧客の年齢が70歳未満ならfalseを返す(): void
    {
        $customer = $this->customerFacotry(new Age(69), new IdentificationCertificate());
        $this->assertFalse($this->specification->isSatisfiedBy($customer));
    }
}
