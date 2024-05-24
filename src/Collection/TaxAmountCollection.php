<?php

declare(strict_types=1);

namespace VarLabIT\LexofficeBundle\Collection;

use VarLabIT\LexofficeBundle\Entity\TaxAmount;

class TaxAmountCollection extends AbstractCollection
{
    public function add(TaxAmount $taxAmount): void
    {
        $this->list[] = $taxAmount;
    }
}
