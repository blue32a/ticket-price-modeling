<?php

declare(strict_types=1);

namespace Tests\Customers\Types\Specifications;

use PHPUnit\Framework\TestCase;
use TicketPriceModeling\Customers\Age;
use TicketPriceModeling\Customers\Customer;
use TicketPriceModeling\Customers\Certificate\DisabilityCertificate;
use TicketPriceModeling\Customers\Types\Specifications\DisabilitySpecification;

class DisabilitySpecificationTest extends TestCase
{
    private DisabilitySpecification $specification;

    private function customerFacotry(
        ?DisabilityCertificate $disabilityCertificate
    ): Customer {
        return new Customer(new Age(20), null, null, null, $disabilityCertificate);
    }

    public function setUp(): void
    {
        $this->specification = new DisabilitySpecification();
    }

    /**
     * @test
     */
    public function 顧客が障がい者証明書を持っているならtrueを返す(): void
    {
        $customer = $this->customerFacotry(new DisabilityCertificate());
        $this->assertTrue($this->specification->isSatisfiedBy($customer));
    }

    /**
     * @test
     */
    public function 顧客が障がい者証明書を持っていないならfalseを返す(): void
    {
        $customer = $this->customerFacotry(null);
        $this->assertFalse($this->specification->isSatisfiedBy($customer));
    }
}
