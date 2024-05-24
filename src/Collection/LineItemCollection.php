<?php

declare(strict_types=1);

namespace VarLabIT\LexofficeBundle\Collection;

use VarLabIT\LexofficeBundle\Entity\LineItem;

class LineItemCollection extends AbstractCollection
{
    public function add(LineItem $lineItem): void
    {
        $this->list[] = $lineItem;
    }
}
