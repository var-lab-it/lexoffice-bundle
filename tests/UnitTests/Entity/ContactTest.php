<?php

declare(strict_types=1);

namespace Tests\VarLabIT\LexofficeBundle\UnitTests\Entity;

use PHPUnit\Framework\TestCase;
use VarLabIT\LexofficeBundle\Collection\AddressCollection;
use VarLabIT\LexofficeBundle\Collection\EmailAddressCollection;
use VarLabIT\LexofficeBundle\Collection\PhoneNumberCollection;
use VarLabIT\LexofficeBundle\Collection\RoleCollection;
use VarLabIT\LexofficeBundle\Collection\TypedAddressCollection;
use VarLabIT\LexofficeBundle\Entity\Address;
use VarLabIT\LexofficeBundle\Entity\Company;
use VarLabIT\LexofficeBundle\Entity\Contact;
use VarLabIT\LexofficeBundle\Entity\ContactRole;
use VarLabIT\LexofficeBundle\Entity\Enum\AddressType;
use VarLabIT\LexofficeBundle\Entity\Enum\RoleType;
use VarLabIT\LexofficeBundle\Entity\XRechnungReference;

class ContactTest extends TestCase
{
    public function testGetAndSetId(): void
    {
        $contact = new Contact();
        $id      = '12345';

        $contact->setId($id);
        self::assertSame($id, $contact->getId());
    }

    public function testGetAndSetOrganizationId(): void
    {
        $contact        = new Contact();
        $organizationId = '67890';

        $contact->setOrganizationId($organizationId);
        self::assertSame($organizationId, $contact->getOrganizationId());
    }

    public function testGetAndSetRoles(): void
    {
        $contact = new Contact();
        $roles   = new RoleCollection();

        $contact->setRoles($roles);
        self::assertSame($roles, $contact->getRoles());
    }

    public function testAddRole(): void
    {
        $contact = new Contact();
        $role    = $this->createMock(ContactRole::class);

        $contact->addRole(RoleType::CUSTOMER, $role);
        self::assertCount(1, $contact->getRoles());
    }

    public function testGetAndSetVersion(): void
    {
        $contact = new Contact();
        $version = 1;

        $contact->setVersion($version);
        self::assertSame($version, $contact->getVersion());
    }

    public function testGetAndSetCompany(): void
    {
        $contact = new Contact();
        $company = $this->createMock(Company::class);

        $contact->setCompany($company);
        self::assertSame($company, $contact->getCompany());
    }

    public function testGetAndSetAddresses(): void
    {
        $contact   = new Contact();
        $addresses = new TypedAddressCollection();

        $contact->setAddresses($addresses);
        self::assertSame($addresses, $contact->getAddresses());
    }

    public function testAddAddress(): void
    {
        $contact           = new Contact();
        $address           = $this->createMock(Address::class);
        $addressCollection = new AddressCollection();

        $contact->getAddresses()->add(AddressType::BILLING, $addressCollection);
        $contact->addAddress(AddressType::BILLING, $address);

        self::assertCount(
            1,
            /** @phpstan-ignore-next-line */
            $contact->getAddresses()->findByType(AddressType::BILLING)->getIterator(),
        );
    }

    public function testGetAndSetXRechnung(): void
    {
        $contact   = new Contact();
        $xRechnung = $this->createMock(XRechnungReference::class);

        $contact->setXRechnung($xRechnung);
        self::assertSame($xRechnung, $contact->getXRechnung());
    }

    public function testGetAndSetEmailAddresses(): void
    {
        $contact        = new Contact();
        $emailAddresses = new EmailAddressCollection();

        $contact->setEmailAddresses($emailAddresses);
        self::assertSame($emailAddresses, $contact->getEmailAddresses());
    }

    public function testGetAndSetPhoneNumbers(): void
    {
        $contact      = new Contact();
        $phoneNumbers = new PhoneNumberCollection();

        $contact->setPhoneNumbers($phoneNumbers);
        self::assertSame($phoneNumbers, $contact->getPhoneNumbers());
    }

    public function testGetAndSetNote(): void
    {
        $contact = new Contact();
        $note    = 'Test note';

        $contact->setNote($note);
        self::assertSame($note, $contact->getNote());
    }

    public function testIsAndSetArchived(): void
    {
        $contact  = new Contact();
        $archived = true;

        $contact->setArchived($archived);
        self::assertSame($archived, $contact->isArchived());
    }
}
