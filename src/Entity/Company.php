<?php

declare(strict_types=1);

namespace VarLabIT\LexofficeBundle\Entity;

use Symfony\Component\Validator\Constraints\NotBlank;
use VarLabIT\LexofficeBundle\Collection\PersonCollection;

class Company implements EntityInterface
{
    #[NotBlank]
    private string $name;
    private string $taxNumber;
    private string $vatRegistrationId;
    private bool $allowTaxFreeInvoices;
    private PersonCollection $contactPersons;

    public function __construct()
    {
        $this->contactPersons = new PersonCollection();
    }

    public function addContactPerson(Person $person): self
    {
        $this->contactPersons->add($person);

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getTaxNumber(): string
    {
        return $this->taxNumber;
    }

    public function setTaxNumber(string $taxNumber): self
    {
        $this->taxNumber = $taxNumber;

        return $this;
    }

    public function getVatRegistrationId(): string
    {
        return $this->vatRegistrationId;
    }

    public function setVatRegistrationId(string $vatRegistrationId): self
    {
        $this->vatRegistrationId = $vatRegistrationId;

        return $this;
    }

    public function isAllowTaxFreeInvoices(): bool
    {
        return $this->allowTaxFreeInvoices;
    }

    public function setAllowTaxFreeInvoices(bool $allowTaxFreeInvoices): self
    {
        $this->allowTaxFreeInvoices = $allowTaxFreeInvoices;

        return $this;
    }

    public function getContactPersons(): PersonCollection
    {
        return $this->contactPersons;
    }

    public function setContactPersons(PersonCollection $contactPersons): self
    {
        $this->contactPersons = $contactPersons;

        return $this;
    }
}
