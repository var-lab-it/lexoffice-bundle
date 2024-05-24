<?php

declare(strict_types=1);

namespace VarLabIT\LexofficeBundle\Entity\Enum;

enum VoucherStatus: string
{
    case DRAFT  = 'draft';
    case OPEN   = 'open';
    case PAID   = 'paid';
    case VOIDED = 'voided';
}
