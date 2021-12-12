<?php

declare(strict_types=1);

namespace Tests\Customers\Types\Specifications;

use PHPUnit\Framework\TestCase;
use TicketPriceModeling\Customers\Age;
use TicketPriceModeling\Customers\Customer;
use TicketPriceModeling\Customers\Certificate\HighSchoolStudentCertificate;
use TicketPriceModeling\Customers\Certificate\MiddleSchoolStudentCetficate;
use TicketPriceModeling\Customers\Certificate\StudentCertificate;
use TicketPriceModeling\Customers\Types\Specifications\HighSchoolStudentSpecification;

class HighSchoolStudentSpecificationTest extends TestCase
{
    private HighSchoolStudentSpecification $specification;

    private function customerFacotry(?StudentCertificate $studentCertificate): Customer
    {
        return new Customer(new Age(13), null, null, $studentCertificate, null);
    }

    public function setUp(): void
    {
        $this->specification = new HighSchoolStudentSpecification();
    }

    /**
     * @test
     */
    public function 顧客が高校の学生証明書を持っていたらtrueを返す(): void
    {
        $customer = $this->customerFacotry(new HighSchoolStudentCertificate());
        $this->assertTrue($this->specification->isSatisfiedBy($customer));
    }

    /**
     * @test
     */
    public function 顧客が高校以外の学生証明書を持っていたらfalseを返す(): void
    {
        $customer = $this->customerFacotry(new MiddleSchoolStudentCetficate());
        $this->assertFalse($this->specification->isSatisfiedBy($customer));
    }

    /**
     * @test
     */
    public function 顧客が学生証明書を持っていなければfalseを返す(): void
    {
        $customer = $this->customerFacotry(null);
        $this->assertFalse($this->specification->isSatisfiedBy($customer));
    }
}
