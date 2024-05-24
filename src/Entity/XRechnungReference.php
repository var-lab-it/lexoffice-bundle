<?php

declare(strict_types=1);

namespace VarLabIT\LexofficeBundle\Entity;

class XRechnungReference implements EntityInterface
{
    private string $buyerReference;
    private string $vendorNumberAtCustomer;

    public function getBuyerReference(): string
    {
        return $this->buyerReference;
    }

    public function setBuyerReference(string $buyerReference): self
    {
        $this->buyerReference = $buyerReference;

        return $this;
    }

    public function getVendorNumberAtCustomer(): string
    {
        return $this->vendorNumberAtCustomer;
    }

    public function setVendorNumberAtCustomer(string $vendorNumberAtCustomer): self
    {
        $this->vendorNumberAtCustomer = $vendorNumberAtCustomer;

        return $this;
    }
}
