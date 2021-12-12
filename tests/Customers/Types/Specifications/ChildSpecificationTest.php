<?php

declare(strict_types=1);

namespace Tests\Customers\Types\Specifications;

use PHPUnit\Framework\TestCase;
use TicketPriceModeling\Customers\Age;
use TicketPriceModeling\Customers\Customer;
use TicketPriceModeling\Customers\Types\Specifications\ChildSpecification;

class ChildSpecificationTest extends TestCase
{
    private ChildSpecification $specification;

    private function customerFacotry(Age $age): Customer
    {
        return new Customer($age, null, null, null, null);
    }

    public function setUp(): void
    {
        $this->specification = new ChildSpecification();
    }

    /**
     * @test
     */
    public function 顧客の年齢が12歳以下ならtrueを返す(): void
    {
        $customer = $this->customerFacotry(new Age(12));
        $this->assertTrue($this->specification->isSatisfiedBy($customer));
    }

    /**
     * @test
     */
    public function 顧客の年齢が12歳より大きいならfalseを返す(): void
    {
        $customer = $this->customerFacotry(new Age(13));
        $this->assertFalse($this->specification->isSatisfiedBy($customer));
    }
}
