<?php

declare(strict_types=1);

namespace VarLabIT\LexofficeBundle\Entity;

class PaymentDiscountConditions implements EntityInterface
{
    private float $discountPercentage;
    private int $discountRange;

    public function getDiscountPercentage(): float
    {
        return $this->discountPercentage;
    }

    public function setDiscountPercentage(float $discountPercentage): self
    {
        $this->discountPercentage = $discountPercentage;

        return $this;
    }

    public function getDiscountRange(): int
    {
        return $this->discountRange;
    }

    public function setDiscountRange(int $discountRange): self
    {
        $this->discountRange = $discountRange;

        return $this;
    }
}
