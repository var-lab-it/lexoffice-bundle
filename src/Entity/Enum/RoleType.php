<?php

declare(strict_types=1);

namespace VarLabIT\LexofficeBundle\Entity\Enum;

enum RoleType: string
{
    case CUSTOMER = 'customer';
    case VENDOR   = 'vendor';
}
