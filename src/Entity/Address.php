<?php

declare(strict_types=1);

namespace VarLabIT\LexofficeBundle\Entity;

use Symfony\Component\Validator\Constraints\NotBlank;

class Address implements EntityInterface
{
    private string $supplement;
    private string $street;
    private string $zip;
    private string $city;
    private string $contactId;

    public function getContactId(): string
    {
        return $this->contactId;
    }

    public function setContactId(string $contactId): self
    {
        $this->contactId = $contactId;

        return $this;
    }

    #[NotBlank]
    private string $countryCode;

    public function getSupplement(): string
    {
        return $this->supplement;
    }

    public function setSupplement(string $supplement): self
    {
        $this->supplement = $supplement;

        return $this;
    }

    public function getStreet(): string
    {
        return $this->street;
    }

    public function setStreet(string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getZip(): string
    {
        return $this->zip;
    }

    public function setZip(string $zip): self
    {
        $this->zip = $zip;

        return $this;
    }

    public function getCity(): string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCountryCode(): string
    {
        return $this->countryCode;
    }

    public function setCountryCode(string $countryCode): self
    {
        $this->countryCode = $countryCode;

        return $this;
    }
}
