<?php

declare(strict_types=1);

namespace Tests\VarLabIT\LexofficeBundle\UnitTests\Transformer;

use PHPUnit\Framework\TestCase;
use Spatie\Snapshots\MatchesSnapshots;
use VarLabIT\LexofficeBundle\Transformer\ContactTransformer;
use function Safe\file_get_contents;

class ContactTransformerTest extends TestCase
{
    use MatchesSnapshots;

    public function testTransformToObject(): void
    {
        $data = file_get_contents(__DIR__ . '/mocks/contact_1.json');

        $result = ContactTransformer::getInstance()->transformToObject($data);

        self::assertEquals('be9475f4-ef80-442b-8ab9-3ab8b1a2aeb9', $result->getId());
        self::assertEquals('Testfirma', $result->getCompany()->getName());
        self::assertCount(1, $result->getCompany()->getContactPersons()->getIterator());
        self::assertEquals(
            'contactpersonmail@lexoffice.de',
            /** @phpstan-ignore-next-line */
            $result->getCompany()->getContactPersons()->getIterator()[0]->getEmailAddress(),
        );

        self::assertCount(2, $result->getAddresses()->getIterator());
        self::assertCount(4, $result->getEmailAddresses()->getIterator());
        self::assertCount(6, $result->getPhoneNumbers()->getIterator());
    }

    public function testTransformFromObject(): void
    {
        $data = file_get_contents(__DIR__ . '/mocks/contact_1.json');

        $contact = ContactTransformer::getInstance()->transformToObject($data);

        $array = ContactTransformer::getInstance()->transformFromObject($contact);

        /** @phpstan-ignore-next-line */
        unset($array['roles']['customer']);
        /** @phpstan-ignore-next-line */
        unset($array['roles']['vendor']);

        $this->assertMatchesJsonSnapshot($array);
    }
}
