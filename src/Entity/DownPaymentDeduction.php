<?php

declare(strict_types=1);

namespace VarLabIT\LexofficeBundle\Entity;

use Safe\DateTime;

class DownPaymentDeduction implements EntityInterface
{
    private string $id;
    private string $voucherType;
    private string $title;
    private string $voucherNumber;
    private DateTime $voucherDate;
    private float $receivedGrossAmount;
    private float $receivedNetAmount;
    private float $receivedTaxAmount;
    private float $taxRatePercentage;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getVoucherType(): string
    {
        return $this->voucherType;
    }

    public function setVoucherType(string $voucherType): self
    {
        $this->voucherType = $voucherType;

        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getVoucherNumber(): string
    {
        return $this->voucherNumber;
    }

    public function setVoucherNumber(string $voucherNumber): self
    {
        $this->voucherNumber = $voucherNumber;

        return $this;
    }

    public function getVoucherDate(): DateTime
    {
        return $this->voucherDate;
    }

    public function setVoucherDate(DateTime $voucherDate): self
    {
        $this->voucherDate = $voucherDate;

        return $this;
    }

    public function getReceivedGrossAmount(): float
    {
        return $this->receivedGrossAmount;
    }

    public function setReceivedGrossAmount(float $receivedGrossAmount): self
    {
        $this->receivedGrossAmount = $receivedGrossAmount;

        return $this;
    }

    public function getReceivedNetAmount(): float
    {
        return $this->receivedNetAmount;
    }

    public function setReceivedNetAmount(float $receivedNetAmount): self
    {
        $this->receivedNetAmount = $receivedNetAmount;

        return $this;
    }

    public function getReceivedTaxAmount(): float
    {
        return $this->receivedTaxAmount;
    }

    public function setReceivedTaxAmount(float $receivedTaxAmount): self
    {
        $this->receivedTaxAmount = $receivedTaxAmount;

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
