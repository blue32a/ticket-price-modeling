<?php

declare(strict_types=1);

namespace Tests\Customer\Type\Specification;

use PHPUnit\Framework\TestCase;
use TicketPriceModeling\Customer\Age;
use TicketPriceModeling\Customer\Person;
use TicketPriceModeling\Customer\Type\Specification\GeneralSpecification;

class GeneralSpecificationTest extends TestCase
{
    private GeneralSpecification $specification;

    private function factoryCustomerPerson(Age $age): Person
    {
        return new Person($age, null, null, null, null);
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
        $customer = $this->factoryCustomerPerson(new Age(13));
        $this->assertTrue($this->specification->isSatisfiedBy($customer));
    }

    /**
     * @test
     */
    public function 顧客の年齢が13歳未満ならfalse(): void
    {
        $customer = $this->factoryCustomerPerson(new Age(12));
        $this->assertFalse($this->specification->isSatisfiedBy($customer));
    }
}
