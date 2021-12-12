<?php

declare(strict_types=1);

namespace Tests\Customers\Types\Specifications;

use PHPUnit\Framework\TestCase;
use TicketPriceModeling\Customers\Age;
use TicketPriceModeling\Customers\Customer;
use TicketPriceModeling\Customers\Certificate\CitizenMemberCertificate;
use TicketPriceModeling\Customers\Types\Specifications\CitizenMemberSeniorSpecification;

class CitizenMemberSeniorSpecificationTest extends TestCase
{
    private CitizenMemberSeniorSpecification $specification;

    private function customerFacotry(
        Age $age,
        ?CitizenMemberCertificate $citizenMember
    ): Customer {
        return new Customer($age, null, $citizenMember, null, null);
    }

    public function setUp(): void
    {
        $this->specification = new CitizenMemberSeniorSpecification();
    }

    /**
     * @test
     */
    public function 顧客がシネマシティズン会員証明書を持っていて、かつ年齢が60歳以上の場合はtrueを返す(): void
    {
        $customer = $this->customerFacotry(new Age(60), new CitizenMemberCertificate());
        $this->assertTrue($this->specification->isSatisfiedBy($customer));
    }

    /**
     * @test
     */
    public function 顧客がシネマシティズン会員証明書を持っていない、かつ年齢が60歳以上の場合はfalseを返す(): void
    {
        $customer = $this->customerFacotry(new Age(60), null);
        $this->assertFalse($this->specification->isSatisfiedBy($customer));
    }

    /**
     * @test
     */
    public function 顧客がシネマシティズン会員証明書を持っていて、かつ年齢が60歳未満の場合はfalseを返す(): void
    {
        $customer = $this->customerFacotry(new Age(59), new CitizenMemberCertificate());
        $this->assertFalse($this->specification->isSatisfiedBy($customer));
    }
}
