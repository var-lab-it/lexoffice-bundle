<?php

declare(strict_types=1);

namespace Tests\VarLabIT\LexofficeBundle\UnitTests\Collection;

use PHPUnit\Framework\TestCase;
use VarLabIT\LexofficeBundle\Collection\FileCollection;
use VarLabIT\LexofficeBundle\Entity\File;

class FileCollectionTest extends TestCase
{
    public function testAdd(): void
    {
        $collection = new FileCollection();

        $collection->add(new File());

        self::assertCount(1, $collection->getIterator());
    }
}
