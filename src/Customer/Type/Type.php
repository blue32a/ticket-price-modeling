<?php

declare(strict_types=1);

namespace TicketPriceModeling\Customer\Type;

enum Type: string
{
    case Child               = '1';
    case CinemaCitizen       = '2';
    case CinemaCitizenSenior = '3';
    case Disability          = '4';
    case General             = '5';
    case HighSchoolStudent   = '6';
    case MiddleSchoolStudent = '7';
    case ProfessionalStudent = '8';
    case Senior              = '9';
    case UniversityStudent   = '10';
}
