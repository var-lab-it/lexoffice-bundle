<?php

declare(strict_types=1);

namespace Tests\VarLabIT\LexofficeBundle\UnitTests\Collection;

use PHPUnit\Framework\TestCase;
use VarLabIT\LexofficeBundle\Collection\EmailAddressCollection;
use VarLabIT\LexofficeBundle\Entity\Enum\EmailAddressType;

class EmailAddressCollectionTest extends TestCase
{
    public function testAdd(): void
    {
        $collection = new EmailAddressCollection();

        $collection
            ->add(EmailAddressType::BUSINESS, ['test@email.com']);

        self::assertCount(1, $collection);
    }

    public function testFindExists(): void
    {
        $collection = new EmailAddressCollection();

        $collection
            ->add(EmailAddressType::BUSINESS, ['test@email.com']);

        self::assertCount(1, $collection);
        /** @phpstan-ignore-next-line */
        self::assertEquals('test@email.com', $collection->findByType(EmailAddressType::BUSINESS)->getIterator()[0]);
    }

    public function testFindNotExists(): void
    {
        $collection = new EmailAddressCollection();

        $collection
            ->add(EmailAddressType::BUSINESS, ['test@email.com']);

        self::assertCount(1, $collection);
        self::assertEquals(null, $collection->findByType(EmailAddressType::OFFICE));
    }
}
