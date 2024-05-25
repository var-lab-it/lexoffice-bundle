<?php

declare(strict_types=1);

namespace Tests\VarLabIT\LexofficeBundle\UnitTests\Entity;

use PHPUnit\Framework\TestCase;
use VarLabIT\LexofficeBundle\Entity\Address;

class AddressTest extends TestCase
{
    public function testGetAndSetContactId(): void
    {
        $address   = new Address();
        $contactId = '12345';

        $address->setContactId($contactId);
        self::assertSame($contactId, $address->getContactId());
    }

    public function testGetAndSetSupplement(): void
    {
        $address    = new Address();
        $supplement = 'Apt 101';

        $address->setSupplement($supplement);
        self::assertSame($supplement, $address->getSupplement());
    }

    public function testGetAndSetStreet(): void
    {
        $address = new Address();
        $street  = '123 Main St';

        $address->setStreet($street);
        self::assertSame($street, $address->getStreet());
    }

    public function testGetAndSetZip(): void
    {
        $address = new Address();
        $zip     = '12345';

        $address->setZip($zip);
        self::assertSame($zip, $address->getZip());
    }

    public function testGetAndSetCity(): void
    {
        $address = new Address();
        $city    = 'Sample City';

        $address->setCity($city);
        self::assertSame($city, $address->getCity());
    }

    public function testGetAndSetCountryCode(): void
    {
        $address     = new Address();
        $countryCode = 'DE';

        $address->setCountryCode($countryCode);
        self::assertSame($countryCode, $address->getCountryCode());
    }
}
