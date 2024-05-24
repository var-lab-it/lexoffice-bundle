<?php

declare(strict_types=1);

namespace VarLabIT\LexofficeBundle\Entity\Enum;

enum TaxSubType: string
{
    case DISTANCE_SALES      = 'distanceSales'; // distanceSales
    case ELECTRONIC_SERVICES = 'electronicServices'; // electronicServices
    case STANDARD            = 'standard'; // standard voucher
}
