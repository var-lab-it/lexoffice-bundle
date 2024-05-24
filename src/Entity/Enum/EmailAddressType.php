<?php

declare(strict_types=1);

namespace VarLabIT\LexofficeBundle\Entity\Enum;

enum EmailAddressType: string
{
    case BUSINESS = 'business';
    case OFFICE   = 'office';
    case PRIVATE  = 'private';
    case OTHER    = 'other';
}
