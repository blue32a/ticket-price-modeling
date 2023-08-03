<?php

declare(strict_types=1);

namespace TicketPriceModeling\Customer\Type;

use TicketPriceModeling\Customer\Person;
use TicketPriceModeling\Customer\Type\Specification\ChildSpecification;
use TicketPriceModeling\Customer\Type\Specification\CinemaCitizenSeniorSpecification;
use TicketPriceModeling\Customer\Type\Specification\CinemaCitizenSpecification;
use TicketPriceModeling\Customer\Type\Specification\DisabilitySpecification;
use TicketPriceModeling\Customer\Type\Specification\GeneralSpecification;
use TicketPriceModeling\Customer\Type\Specification\HighSchoolStudentSpecification;
use TicketPriceModeling\Customer\Type\Specification\MiddleSchoolStudentSpecification;
use TicketPriceModeling\Customer\Type\Specification\ProfessionalStudentSpecification;
use TicketPriceModeling\Customer\Type\Specification\SeniorSpecification;
use TicketPriceModeling\Customer\Type\Specification\Specification;
use TicketPriceModeling\Customer\Type\Specification\UniversityStudentSpecification;

class TypeEvaluation
{
    /** @var Specification[] */
    private array $specifications;

    public function __construct()
    {
        $this->specifications = [
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
    }

    /**
     * @return Type[]
     */
    public function evaluate(Person $person): array
    {
        $types = [];

        foreach ($this->specifications as $specification) {
            if ($specification->isSatisfiedBy($person)) {
                $types[] = $specification->type();
            }
        }

        return $types;
    }
}
