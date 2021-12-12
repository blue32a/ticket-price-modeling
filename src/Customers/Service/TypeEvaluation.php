<?php

declare(strict_types=1);

namespace TicketPriceModeling\Customers\Service;

use TicketPriceModeling\Customers\Customer;
use TicketPriceModeling\Customers\Types\Child;
use TicketPriceModeling\Customers\Types\CitizenMember;
use TicketPriceModeling\Customers\Types\CitizenMemberSenior;
use TicketPriceModeling\Customers\Types\Disability;
use TicketPriceModeling\Customers\Types\General;
use TicketPriceModeling\Customers\Types\HighSchoolStudent;
use TicketPriceModeling\Customers\Types\MiddleSchoolStudent;
use TicketPriceModeling\Customers\Types\ProfessionalStudent;
use TicketPriceModeling\Customers\Types\Senior;
use TicketPriceModeling\Customers\Types\Specifications\ChildSpecification;
use TicketPriceModeling\Customers\Types\Specifications\CitizenMemberSeniorSpecification;
use TicketPriceModeling\Customers\Types\Specifications\CitizenMemberSpecification;
use TicketPriceModeling\Customers\Types\Specifications\DisabilitySpecification;
use TicketPriceModeling\Customers\Types\Specifications\GeneralSpecification;
use TicketPriceModeling\Customers\Types\Specifications\HighSchoolStudentSpecification;
use TicketPriceModeling\Customers\Types\Specifications\MiddleSchoolStudentSpecification;
use TicketPriceModeling\Customers\Types\Specifications\ProfessionalStudentSpecification;
use TicketPriceModeling\Customers\Types\Specifications\SeniorSpecification;
use TicketPriceModeling\Customers\Types\Specifications\UniversityStudentSpecification;
use TicketPriceModeling\Customers\Types\UniversityStudent;

class TypeEvaluation
{
    public static function evaluation(Customer $customer): array
    {
        $types = [];

        if ((new ChildSpecification())->isSatisfiedBy($customer)) {
            $types[] = new Child();
        }
        if ((new CitizenMemberSpecification())->isSatisfiedBy($customer)) {
            $types[] = new CitizenMember();
        }
        if ((new CitizenMemberSeniorSpecification())->isSatisfiedBy($customer)) {
            $types[] = new CitizenMemberSenior();
        }
        if ((new DisabilitySpecification())->isSatisfiedBy($customer)) {
            $types[] = new Disability();
        }
        if ((new GeneralSpecification())->isSatisfiedBy($customer)) {
            $types[] = new General();
        }
        if ((new HighSchoolStudentSpecification())->isSatisfiedBy($customer)) {
            $types[] = new HighSchoolStudent();
        }
        if ((new MiddleSchoolStudentSpecification())->isSatisfiedBy($customer)) {
            $types[] = new MiddleSchoolStudent();
        }
        if ((new ProfessionalStudentSpecification())->isSatisfiedBy($customer)) {
            $types[] = new ProfessionalStudent();
        }
        if ((new SeniorSpecification())->isSatisfiedBy($customer)) {
            $types[] = new Senior();
        }
        if ((new UniversityStudentSpecification())->isSatisfiedBy($customer)) {
            $types[] = new UniversityStudent();
        }

        return $types;
    }
}
