<?php

declare(strict_types=1);

namespace TicketPriceModeling\Customers\Service;

use TicketPriceModeling\Customers\Customer;
use TicketPriceModeling\Customers\Types\Child;
use TicketPriceModeling\Customers\Types\CinemaCitizen;
use TicketPriceModeling\Customers\Types\CinemaCitizenSenior;
use TicketPriceModeling\Customers\Types\Disability;
use TicketPriceModeling\Customers\Types\General;
use TicketPriceModeling\Customers\Types\HighSchoolStudent;
use TicketPriceModeling\Customers\Types\MiddleSchoolStudent;
use TicketPriceModeling\Customers\Types\ProfessionalStudent;
use TicketPriceModeling\Customers\Types\Senior;
use TicketPriceModeling\Customers\Types\Specifications\ChildSpecification;
use TicketPriceModeling\Customers\Types\Specifications\CinemaCitizenSeniorSpecification;
use TicketPriceModeling\Customers\Types\Specifications\CinemaCitizenSpecification;
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
        if ((new CinemaCitizenSpecification())->isSatisfiedBy($customer)) {
            $types[] = new CinemaCitizen();
        }
        if ((new CinemaCitizenSeniorSpecification())->isSatisfiedBy($customer)) {
            $types[] = new CinemaCitizenSenior();
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
