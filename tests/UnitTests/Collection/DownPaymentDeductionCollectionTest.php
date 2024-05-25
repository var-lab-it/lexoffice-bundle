<?php

declare(strict_types=1);

namespace Tests\VarLabIT\LexofficeBundle\UnitTests\Collection;

use PHPUnit\Framework\TestCase;
use VarLabIT\LexofficeBundle\Collection\DownPaymentDeductionCollection;
use VarLabIT\LexofficeBundle\Entity\DownPaymentDeduction;

class DownPaymentDeductionCollectionTest extends TestCase
{
    public function testAdd(): void
    {
        $collection = new DownPaymentDeductionCollection();

        $collection->add(new DownPaymentDeduction());

        self::assertCount(1, $collection->getIterator());
    }
}
