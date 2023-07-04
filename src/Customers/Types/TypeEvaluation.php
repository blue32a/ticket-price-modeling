<?php

declare(strict_types=1);

namespace TicketPriceModeling\Customers\Types;

use TicketPriceModeling\Customers\Customer;
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

class TypeEvaluation
{
    /**
     * @return Type[]
     */
    public static function evaluate(Customer $customer): array
    {
        $specifications = [
            new ChildSpecification(),
            new CinemaCitizenSeniorSpecification(),
            new CinemaCitizenSpecification(),
            new DisabilitySpecification(),
            new GeneralSpecification(),
            new HighSchoolStudentSpecification(),
            new MiddleSchoolStudentSpecification(),
            new ProfessionalStudentSpecification(),
            new SeniorSpecification(),
            new UniversityStudentSpecification(),
        ];
        $types = [];

        foreach ($specifications as $specification) {
            if ($specification->isSatisfiedBy($customer)) {
                $types[] = $specification->type();
            }
        }

        return $types;
    }
}
