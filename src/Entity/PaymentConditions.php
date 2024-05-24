<?php

declare(strict_types=1);

namespace VarLabIT\LexofficeBundle\Entity;

class PaymentConditions implements EntityInterface
{
    private string $paymentTermLabel;
    private string $paymentTermLabelTemplate;
    private int $paymentTermDuration;
    private PaymentDiscountConditions $paymentDiscountConditions;

    public function getPaymentTermLabel(): string
    {
        return $this->paymentTermLabel;
    }

    public function setPaymentTermLabel(string $paymentTermLabel): self
    {
        $this->paymentTermLabel = $paymentTermLabel;

        return $this;
    }

    public function getPaymentTermLabelTemplate(): string
    {
        return $this->paymentTermLabelTemplate;
    }

    public function setPaymentTermLabelTemplate(string $paymentTermLabelTemplate): self
    {
        $this->paymentTermLabelTemplate = $paymentTermLabelTemplate;

        return $this;
    }

    public function getPaymentTermDuration(): int
    {
        return $this->paymentTermDuration;
    }

    public function setPaymentTermDuration(int $paymentTermDuration): self
    {
        $this->paymentTermDuration = $paymentTermDuration;

        return $this;
    }

    public function getPaymentDiscountConditions(): PaymentDiscountConditions
    {
        return $this->paymentDiscountConditions;
    }

    public function setPaymentDiscountConditions(PaymentDiscountConditions $paymentDiscountConditions): self
    {
        $this->paymentDiscountConditions = $paymentDiscountConditions;

        return $this;
    }
}
