<?php

declare(strict_types=1);

namespace VarLabIT\LexofficeBundle\Entity;

use Safe\DateTimeImmutable;
use VarLabIT\LexofficeBundle\Entity\Enum\ShippingType;

class ShippingConditions
{
    private DateTimeImmutable $shippingDate;
    private DateTimeImmutable $shippingEndDate;
    private ShippingType $shippingType;

    public function getShippingDate(): DateTimeImmutable
    {
        return $this->shippingDate;
    }

    public function setShippingDate(DateTimeImmutable $shippingDate): self
    {
        $this->shippingDate = $shippingDate;

        return $this;
    }

    public function getShippingEndDate(): DateTimeImmutable
    {
        return $this->shippingEndDate;
    }

    public function setShippingEndDate(DateTimeImmutable $shippingEndDate): self
    {
        $this->shippingEndDate = $shippingEndDate;

        return $this;
    }

    public function getShippingType(): ShippingType
    {
        return $this->shippingType;
    }

    public function setShippingType(ShippingType $shippingType): self
    {
        $this->shippingType = $shippingType;

        return $this;
    }
}
