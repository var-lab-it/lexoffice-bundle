<?php

declare(strict_types=1);

namespace VarLabIT\LexofficeBundle\Entity\Enum;

enum PhoneNumberType: string
{
    case BUSINESS = 'business';
    case OFFICE   = 'office';
    case PRIVATE  = 'private';
    case OTHER    = 'other';
    case MOBILE   = 'mobile';
    case FAX      = 'fax';
}
