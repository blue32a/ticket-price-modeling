<?php

declare(strict_types=1);

namespace Tests\Customers\Types\Specifications;

use PHPUnit\Framework\TestCase;
use TicketPriceModeling\Customers\Age;
use TicketPriceModeling\Customers\Customer;
use TicketPriceModeling\Customers\Certificate\CitizenMemberCertificate;
use TicketPriceModeling\Customers\Types\Specifications\CitizenMemberSpecification;

class CitizenMemberSpecificationTest extends TestCase
{
    private CitizenMemberSpecification $specification;

    private function customerFacotry(?CitizenMemberCertificate $citizenMember): Customer
    {
        return new Customer(new Age(32), null, $citizenMember, null, null);
    }

    public function setUp(): void
    {
        $this->specification = new CitizenMemberSpecification();
    }

    /**
     * @test
     */
    public function 顧客がシネマシティズン会員証明書を持っていればtrue(): void
    {
        $customer = $this->customerFacotry(new CitizenMemberCertificate());
        $this->assertTrue($this->specification->isSatisfiedBy($customer));
    }

    /**
     * @test
     */
    public function 顧客がシネマシティズン会員証明書を持っていなければfalse(): void
    {
        $customer = $this->customerFacotry(null);
        $this->assertFalse($this->specification->isSatisfiedBy($customer));
    }
}
