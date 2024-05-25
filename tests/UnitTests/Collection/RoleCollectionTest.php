<?php

declare(strict_types=1);

namespace Tests\VarLabIT\LexofficeBundle\UnitTests\Collection;

use PHPUnit\Framework\TestCase;
use VarLabIT\LexofficeBundle\Collection\RoleCollection;
use VarLabIT\LexofficeBundle\Entity\ContactRole;
use VarLabIT\LexofficeBundle\Entity\Enum\RoleType;

class RoleCollectionTest extends TestCase
{
    public function testAdd(): void
    {
        $collection = new RoleCollection();

        $collection->add(RoleType::CUSTOMER, new ContactRole());
        self::assertCount(1, $collection->getIterator());

        $collection->add(RoleType::VENDOR, new ContactRole());
        self::assertCount(2, $collection->getIterator());
    }

    public function testFindByTypeTypeExists(): void
    {
        $collection = new RoleCollection();

        $collection->add(RoleType::CUSTOMER, new ContactRole());
        self::assertCount(1, $collection->getIterator());

        $role = $collection->findByType(RoleType::CUSTOMER);

        self::assertInstanceOf(ContactRole::class, $role);
    }

    public function testFindByTypeTypeNotExists(): void
    {
        $collection = new RoleCollection();

        $collection->add(RoleType::CUSTOMER, new ContactRole());
        self::assertCount(1, $collection->getIterator());

        $role = $collection->findByType(RoleType::VENDOR);

        self::assertNull($role);
    }
}
