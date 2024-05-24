<?php

declare(strict_types=1);

namespace Tests\VarLabIT\LexofficeBundle\UnitTests\Collection;

use PHPUnit\Framework\TestCase;
use VarLabIT\LexofficeBundle\Collection\PersonCollection;
use VarLabIT\LexofficeBundle\Entity\Person;

class PersonCollectionTest extends TestCase
{
    public function testAdd(): void
    {
        $collection = new PersonCollection();

        $person = new Person();
        $person
            ->setFirstName('Max')
            ->setLastName('Müller');

        $collection->add($person);

        self::assertCount(1, $collection);
        /** @phpstan-ignore-next-line */
        self::assertEquals($person, $collection->getIterator()[0]);
    }
}
