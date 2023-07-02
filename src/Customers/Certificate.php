<?php

declare(strict_types=1);

namespace TicketPriceModeling\Customers;

enum Certificate
{
    case Identification;
    case CinemaCitizen;
    case Disability;
    case UniversityStudent;
    case ProfessionalStudent;
    case HighSchoolStudent;
    case MiddleSchoolStudent;
}
