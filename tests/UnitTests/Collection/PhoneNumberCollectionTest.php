<?php

declare(strict_types=1);

namespace Tests\VarLabIT\LexofficeBundle\UnitTests\Collection;

use PHPUnit\Framework\TestCase;
use VarLabIT\LexofficeBundle\Collection\PhoneNumberCollection;
use VarLabIT\LexofficeBundle\Entity\Enum\PhoneNumberType;

class PhoneNumberCollectionTest extends TestCase
{
    public function testAdd(): void
    {
        $collection = new PhoneNumberCollection();

        $collection
            ->add(PhoneNumberType::OFFICE, ['0911/123123123']);

        self::assertCount(1, $collection);
    }

    public function testFindExists(): void
    {
        $collection = new PhoneNumberCollection();

        $collection
            ->add(PhoneNumberType::OFFICE, ['0911/123123123']);

        self::assertCount(1, $collection);
        /** @phpstan-ignore-next-line */
        self::assertEquals('0911/123123123', $collection->findByType(PhoneNumberType::OFFICE)->getIterator()[0]);
    }

    public function testFindNotExists(): void
    {
        $collection = new PhoneNumberCollection();

        $collection
            ->add(PhoneNumberType::OFFICE, ['0911/123123123']);

        self::assertCount(1, $collection);
        self::assertEquals(null, $collection->findByType(PhoneNumberType::BUSINESS));
    }
}
