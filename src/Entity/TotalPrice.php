<?php

declare(strict_types=1);

namespace VarLabIT\LexofficeBundle\Entity;

use VarLabIT\LexofficeBundle\Entity\Enum\Currency;

class TotalPrice implements EntityInterface
{
    private Currency $currency;
    private float $totalNetAmount;
    private float $totalGrossAmount;
    private float $totalTaxAmount;
    private float $totalDiscountAbsolute;
    private float $totalDiscountPercentage;

    public function getCurrency(): Currency
    {
        return $this->currency;
    }

    public function setCurrency(Currency $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    public function getTotalNetAmount(): float
    {
        return $this->totalNetAmount;
    }

    public function setTotalNetAmount(float $totalNetAmount): self
    {
        $this->totalNetAmount = $totalNetAmount;

        return $this;
    }

    public function getTotalGrossAmount(): float
    {
        return $this->totalGrossAmount;
    }

    public function setTotalGrossAmount(float $totalGrossAmount): self
    {
        $this->totalGrossAmount = $totalGrossAmount;

        return $this;
    }

    public function getTotalTaxAmount(): float
    {
        return $this->totalTaxAmount;
    }

    public function setTotalTaxAmount(float $totalTaxAmount): self
    {
        $this->totalTaxAmount = $totalTaxAmount;

        return $this;
    }

    public function getTotalDiscountAbsolute(): float
    {
        return $this->totalDiscountAbsolute;
    }

    public function setTotalDiscountAbsolute(float $totalDiscountAbsolute): self
    {
        $this->totalDiscountAbsolute = $totalDiscountAbsolute;

        return $this;
    }

    public function getTotalDiscountPercentage(): float
    {
        return $this->totalDiscountPercentage;
    }

    public function setTotalDiscountPercentage(float $totalDiscountPercentage): self
    {
        $this->totalDiscountPercentage = $totalDiscountPercentage;

        return $this;
    }
}
