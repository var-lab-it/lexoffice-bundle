<?php

declare(strict_types=1);

namespace Tests\VarLabIT\LexofficeBundle\UnitTests\Collection;

use PHPUnit\Framework\TestCase;
use VarLabIT\LexofficeBundle\Collection\LineItemCollection;
use VarLabIT\LexofficeBundle\Entity\LineItem;

class LineItemCollectionTest extends TestCase
{
    public function testAdd(): void
    {
        $collection = new LineItemCollection();

        $collection->add(new LineItem());

        self::assertCount(1, $collection->getIterator());
    }
}
