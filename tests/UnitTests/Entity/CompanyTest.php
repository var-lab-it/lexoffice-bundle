<?php

declare(strict_types=1);

namespace Tests\VarLabIT\LexofficeBundle\UnitTests\Entity;

use PHPUnit\Framework\TestCase;
use VarLabIT\LexofficeBundle\Collection\PersonCollection;
use VarLabIT\LexofficeBundle\Entity\Company;
use VarLabIT\LexofficeBundle\Entity\Person;

class CompanyTest extends TestCase
{
    public function testGetAndSetName(): void
    {
        $company = new Company();
        $name    = 'Test Company';

        $company->setName($name);
        self::assertSame($name, $company->getName());
    }

    public function testGetAndSetTaxNumber(): void
    {
        $company   = new Company();
        $taxNumber = '123456789';

        $company->setTaxNumber($taxNumber);
        self::assertSame($taxNumber, $company->getTaxNumber());
    }

    public function testGetAndSetVatRegistrationId(): void
    {
        $company           = new Company();
        $vatRegistrationId = 'DE123456789';

        $company->setVatRegistrationId($vatRegistrationId);
        self::assertSame($vatRegistrationId, $company->getVatRegistrationId());
    }

    public function testIsAndSetAllowTaxFreeInvoices(): void
    {
        $company              = new Company();
        $allowTaxFreeInvoices = true;

        $company->setAllowTaxFreeInvoices($allowTaxFreeInvoices);
        self::assertSame($allowTaxFreeInvoices, $company->isAllowTaxFreeInvoices());
    }

    public function testGetAndSetContactPersons(): void
    {
        $company        = new Company();
        $contactPersons = new PersonCollection();
        $person         = $this->createMock(Person::class);
        $contactPersons->add($person);

        $company->setContactPersons($contactPersons);
        self::assertSame($contactPersons, $company->getContactPersons());
    }

    public function testAddContactPerson(): void
    {
        $company = new Company();
        $person  = $this->createMock(Person::class);

        $company->addContactPerson($person);
        self::assertCount(1, $company->getContactPersons());
        /** @phpstan-ignore-next-line */
        self::assertSame($person, $company->getContactPersons()->getIterator()[0]);
    }
}
