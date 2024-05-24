<?php

declare(strict_types=1);

namespace VarLabIT\LexofficeBundle\Entity;

use VarLabIT\LexofficeBundle\Entity\Enum\Currency;

class UnitPrice implements EntityInterface
{
    private Currency $currency;
    private float $netAmount;
    private float $grossAmount;
    private float $taxRatePercentage;

    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    public function setCurrency(Currency $currency): self
    {
        $this->currency = $currency;

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

    public function getGrossAmount(): float
    {
        return $this->grossAmount;
    }

    public function setGrossAmount(float $grossAmount): self
    {
        $this->grossAmount = $grossAmount;

        return $this;
    }

    public function getTaxRatePercentage(): float
    {
        return $this->taxRatePercentage;
    }

    public function setTaxRatePercentage(float $taxRatePercentage): self
    {
        $this->taxRatePercentage = $taxRatePercentage;

        return $this;
    }
}
