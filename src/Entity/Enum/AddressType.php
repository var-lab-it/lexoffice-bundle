<?php

declare(strict_types=1);

namespace VarLabIT\LexofficeBundle\Entity\Enum;

enum AddressType: string
{
    case BILLING  = 'billing';
    case SHIPPING = 'shipping';
}
