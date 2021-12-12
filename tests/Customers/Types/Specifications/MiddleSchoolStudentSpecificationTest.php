<?php

declare(strict_types=1);

namespace Tests\Customers\Types\Specifications;

use PHPUnit\Framework\TestCase;
use TicketPriceModeling\Customers\Age;
use TicketPriceModeling\Customers\Customer;
use TicketPriceModeling\Customers\Certificate\HighSchoolStudentCertificate;
use TicketPriceModeling\Customers\Certificate\MiddleSchoolStudentCetficate;
use TicketPriceModeling\Customers\Certificate\StudentCertificate;
use TicketPriceModeling\Customers\Types\Specifications\MiddleSchoolStudentSpecification;

class MiddleSchoolStudentSpecificationTest extends TestCase
{
    private MiddleSchoolStudentSpecification $specification;

    private function customerFacotry(?StudentCertificate $studentCertificate): Customer
    {
        return new Customer(new Age(13), null, null, $studentCertificate, null);
    }

    public function setUp(): void
    {
        $this->specification = new MiddleSchoolStudentSpecification();
    }

    /**
     * @test
     */
    public function 顧客が中学校の学生証明書を持っていたらtrueを返す(): void
    {
        $customer = $this->customerFacotry(new MiddleSchoolStudentCetficate());
        $this->assertTrue($this->specification->isSatisfiedBy($customer));
    }

    /**
     * @test
     */
    public function 顧客が中学校以外の学生証明書を持っていたらfalseを返す(): void
    {
        $customer = $this->customerFacotry(new HighSchoolStudentCertificate);
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
