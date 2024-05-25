<?php

declare(strict_types=1);

namespace Tests\VarLabIT\LexofficeBundle\UnitTests\Collection;

use PHPUnit\Framework\TestCase;
use VarLabIT\LexofficeBundle\Collection\TaxAmountCollection;
use VarLabIT\LexofficeBundle\Entity\TaxAmount;

class TaxAmountCollectionTest extends TestCase
{
    public function testAdd(): void
    {
        $collection = new TaxAmountCollection();

        $collection->add(new TaxAmount());

        self::assertCount(1, $collection->getIterator());
    }
}
