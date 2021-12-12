<?php

declare(strict_types=1);

namespace Tests\Customers\Types\Specifications;

use PHPUnit\Framework\TestCase;
use TicketPriceModeling\Customers\Age;
use TicketPriceModeling\Customers\Customer;
use TicketPriceModeling\Customers\Types\Specifications\GeneralSpecification;

class GeneralSpecificationTest extends TestCase
{
    private GeneralSpecification $specification;

    private function customerFacotry(Age $age): Customer
    {
        return new Customer($age, null, null, null, null);
    }

    public function setUp(): void
    {
        $this->specification = new GeneralSpecification();
    }

    /**
     * @test
     */
    public function 顧客の年齢が13歳以上ならtrue(): void
    {
        $customer = $this->customerFacotry(new Age(13));
        $this->assertTrue($this->specification->isSatisfiedBy($customer));
    }

    /**
     * @test
     */
    public function 顧客の年齢が13歳未満ならfalse(): void
    {
        $customer = $this->customerFacotry(new Age(12));
        $this->assertFalse($this->specification->isSatisfiedBy($customer));
    }
}
