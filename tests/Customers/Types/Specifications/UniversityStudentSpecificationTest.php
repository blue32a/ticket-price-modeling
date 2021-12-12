<?php

declare(strict_types=1);

namespace Tests\Customers\Types\Specifications;

use PHPUnit\Framework\TestCase;
use TicketPriceModeling\Customers\Age;
use TicketPriceModeling\Customers\Customer;
use TicketPriceModeling\Customers\Certificate\ProfessionalStudentCertificate;
use TicketPriceModeling\Customers\Certificate\StudentCertificate;
use TicketPriceModeling\Customers\Certificate\UniversityStudentCertificate;
use TicketPriceModeling\Customers\Types\Specifications\UniversityStudentSpecification;

class UniversityStudentSpecificationTest extends TestCase
{
    private UniversityStudentSpecification $specification;

    private function customerFacotry(?StudentCertificate $studentCertificate): Customer
    {
        return new Customer(new Age(13), null, null, $studentCertificate, null);
    }

    public function setUp(): void
    {
        $this->specification = new UniversityStudentSpecification();
    }

    /**
     * @test
     */
    public function 顧客が大学の学生証明書を持っていたらtrueを返す(): void
    {
        $customer = $this->customerFacotry(new UniversityStudentCertificate());
        $this->assertTrue($this->specification->isSatisfiedBy($customer));
    }

    /**
     * @test
     */
    public function 顧客が大学以外の学生証明書を持っていればfalseを返す(): void
    {
        $customer = $this->customerFacotry(new ProfessionalStudentCertificate());
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
