<?php

declare(strict_types=1);

namespace VarLabIT\LexofficeBundle\Entity;

use Symfony\Component\Validator\Constraints\NotBlank;
use VarLabIT\LexofficeBundle\Collection\AddressCollection;
use VarLabIT\LexofficeBundle\Collection\EmailAddressCollection;
use VarLabIT\LexofficeBundle\Collection\PhoneNumberCollection;
use VarLabIT\LexofficeBundle\Collection\RoleCollection;
use VarLabIT\LexofficeBundle\Collection\TypedAddressCollection;
use VarLabIT\LexofficeBundle\Entity\Enum\AddressType;
use VarLabIT\LexofficeBundle\Entity\Enum\RoleType;

class Contact implements EntityInterface
{
    #[NotBlank]
    private RoleCollection $roles;
    private string $id;
    private string $organizationId;
    #[NotBlank]
    private int $version;
    private Company $company;
    private TypedAddressCollection $addresses;
    private XRechnungReference $xRechnung;
    private EmailAddressCollection $emailAddresses;
    private PhoneNumberCollection $phoneNumbers;
    private string $note;
    private bool $archived;

    public function __construct()
    {
        $this->addresses = new TypedAddressCollection();
        $this->roles     = new RoleCollection();
    }

    public function addRole(RoleType $roleType, ContactRole $role): self
    {
        $this->roles->add($roleType, $role);

        return $this;
    }

    public function addAddress(AddressType $addressType, Address $address): self
    {
        $collection = $this->addresses->findByType($addressType);

        if ($collection instanceof AddressCollection) {
            $collection->add($address);
        }

        return $this;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getOrganizationId(): string
    {
        return $this->organizationId;
    }

    public function setOrganizationId(string $organizationId): self
    {
        $this->organizationId = $organizationId;

        return $this;
    }

    public function getRoles(): RoleCollection
    {
        return $this->roles;
    }

    public function setRoles(RoleCollection $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getVersion(): int
    {
        return $this->version;
    }

    public function setVersion(int $version): self
    {
        $this->version = $version;

        return $this;
    }

    public function getCompany(): Company
    {
        return $this->company;
    }

    public function setCompany(Company $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getAddresses(): TypedAddressCollection
    {
        return $this->addresses;
    }

    public function setAddresses(TypedAddressCollection $addresses): self
    {
        $this->addresses = $addresses;

        return $this;
    }

    public function getXRechnung(): XRechnungReference
    {
        return $this->xRechnung;
    }

    public function setXRechnung(XRechnungReference $xRechnung): self
    {
        $this->xRechnung = $xRechnung;

        return $this;
    }

    public function getEmailAddresses(): EmailAddressCollection
    {
        return $this->emailAddresses;
    }

    public function setEmailAddresses(EmailAddressCollection $emailAddresses): self
    {
        $this->emailAddresses = $emailAddresses;

        return $this;
    }

    public function getPhoneNumbers(): PhoneNumberCollection
    {
        return $this->phoneNumbers;
    }

    public function setPhoneNumbers(PhoneNumberCollection $phoneNumbers): self
    {
        $this->phoneNumbers = $phoneNumbers;

        return $this;
    }

    public function getNote(): string
    {
        return $this->note;
    }

    public function setNote(string $note): self
    {
        $this->note = $note;

        return $this;
    }

    public function isArchived(): bool
    {
        return $this->archived;
    }

    public function setArchived(bool $archived): self
    {
        $this->archived = $archived;

        return $this;
    }
}
