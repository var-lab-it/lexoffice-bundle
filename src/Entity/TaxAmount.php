<?php

declare(strict_types=1);

namespace VarLabIT\LexofficeBundle\Entity;

class TaxAmount implements EntityInterface
{
    private float $taxRatePercentage;
    private float $taxAmount;
    private float $netAmount;

    public function getTaxRatePercentage(): float
    {
        return $this->taxRatePercentage;
    }

    public function setTaxRatePercentage(float $taxRatePercentage): self
    {
        $this->taxRatePercentage = $taxRatePercentage;

        return $this;
    }

    public function getTaxAmount(): float
    {
        return $this->taxAmount;
    }

    public function setTaxAmount(float $taxAmount): self
    {
        $this->taxAmount = $taxAmount;

        return $this;
    }

    public function getNetAmount(): float
    {
        return $this->netAmount;
    }

    public function setNetAmount(float $netAmount): self
    {
        $this->netAmount = $netAmount;

        return $this;
    }
}
