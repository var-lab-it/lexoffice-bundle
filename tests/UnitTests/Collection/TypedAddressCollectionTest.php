<?php

declare(strict_types=1);

namespace Tests\VarLabIT\LexofficeBundle\UnitTests\Collection;

use PHPUnit\Framework\TestCase;
use VarLabIT\LexofficeBundle\Collection\AddressCollection;
use VarLabIT\LexofficeBundle\Collection\TypedAddressCollection;
use VarLabIT\LexofficeBundle\Entity\Address;
use VarLabIT\LexofficeBundle\Entity\Enum\AddressType;

class TypedAddressCollectionTest extends TestCase
{
    public function testAdd(): void
    {
        $collection = new TypedAddressCollection();

        $address = new Address();
        $address
            ->setCity('Nürnberg');

        $collection
            ->add(AddressType::BILLING, new AddressCollection([$address]));

        self::assertCount(1, $collection);
    }

    public function testFindExists(): void
    {
        $collection = new TypedAddressCollection();

        $address = new Address();
        $address
            ->setCity('Nürnberg');

        $collection
            ->add(AddressType::SHIPPING, new AddressCollection([$address]));

        self::assertCount(1, $collection);
        /** @phpstan-ignore-next-line */
        self::assertEquals('Nürnberg', $collection->findByType(AddressType::SHIPPING)->getIterator()[0]->getCity());
    }

    public function testFindNotExists(): void
    {
        $collection = new TypedAddressCollection();

        $address = new Address();
        $address
            ->setCity('Nürnberg');

        $collection
            ->add(AddressType::SHIPPING, new AddressCollection([$address]));

        self::assertCount(1, $collection);
        self::assertInstanceOf(AddressCollection::class, $collection->findByType(AddressType::BILLING));
        self::assertCount(0, $collection->findByType(AddressType::BILLING)->getIterator());
    }
}
