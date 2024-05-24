<?php

declare(strict_types=1);

namespace VarLabIT\LexofficeBundle\Entity\Enum;

enum LineItemType: string
{
    case SERVICE  = 'service';
    case MATERIAL = 'material';
    case CUSTOM   = 'custom';
    case TEXT     = 'text';
}
