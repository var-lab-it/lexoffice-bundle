<?php

declare(strict_types=1);

namespace VarLabIT\LexofficeBundle\Collection;

use VarLabIT\LexofficeBundle\Entity\DownPaymentDeduction;

class DownPaymentDeductionCollection extends AbstractCollection
{
    public function add(DownPaymentDeduction $downPaymentDeduction): void
    {
        $this->list[] = $downPaymentDeduction;
    }
}
