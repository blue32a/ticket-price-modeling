<?php

declare(strict_types=1);

namespace TicketPriceModeling\Customers\Types;

enum Type
{
    case Child;
    case CinemaCitizen;
    case CinemaCitizenSenior;
    case Disability;
    case General;
    case HighSchoolStudent;
    case MiddleSchoolStudent;
    case ProfessionalStudent;
    case Senior;
    case UniversityStudent;
}
