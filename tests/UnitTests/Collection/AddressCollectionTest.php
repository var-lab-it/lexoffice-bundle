<?php

declare(strict_types=1);

namespace Tests\VarLabIT\LexofficeBundle\UnitTests\Collection;

use PHPUnit\Framework\TestCase;
use VarLabIT\LexofficeBundle\Collection\AddressCollection;
use VarLabIT\LexofficeBundle\Entity\Address;

class AddressCollectionTest extends TestCase
{
    public function testConstructorWithValidAddresses(): void
    {
        $addresses = [
            (new Address()),
            (new Address()),
            (new Address()),
        ];

        $collection = new AddressCollection($addresses);

        self::assertCount(3, $collection->getIterator());
    }

    public function testConstructorWithValidAndInvalidAddresses(): void
    {
        $addresses = [
            (new Address()),
            new \stdClass(),
            (new Address()),
        ];

        /** @phpstan-ignore-next-line */
        $collection = new AddressCollection($addresses);

        self::assertCount(2, $collection->getIterator());
    }

    public function testAdd(): void
    {
        $collection = new AddressCollection();

        $collection->add(new Address());

        self::assertCount(1, $collection->getIterator());
    }
}
