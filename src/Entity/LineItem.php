<?php

declare(strict_types=1);

namespace VarLabIT\LexofficeBundle\Entity;

use VarLabIT\LexofficeBundle\Entity\Enum\LineItemType;

class LineItem implements EntityInterface
{
    private string $id;
    private LineItemType $type;
    private string $name;
    private string $description;
    private float $quantity;
    private string $unitName;
    private UnitPrice $unitPrice;
    private float $discountPercentage;
    private float $lineItemAmount;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getType(): LineItemType
    {
        return $this->type;
    }

    public function setType(LineItemType $type): self
    {
        $this->type = $type;

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

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getQuantity(): float
    {
        return $this->quantity;
    }

    public function setQuantity(float $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getUnitName(): string
    {
        return $this->unitName;
    }

    public function setUnitName(string $unitName): self
    {
        $this->unitName = $unitName;

        return $this;
    }

    public function getUnitPrice(): UnitPrice
    {
        return $this->unitPrice;
    }

    public function setUnitPrice(UnitPrice $unitPrice): self
    {
        $this->unitPrice = $unitPrice;

        return $this;
    }

    public function getDiscountPercentage(): float
    {
        return $this->discountPercentage;
    }

    public function setDiscountPercentage(float $discountPercentage): self
    {
        $this->discountPercentage = $discountPercentage;

        return $this;
    }

    public function getLineItemAmount(): float
    {
        return $this->lineItemAmount;
    }

    public function setLineItemAmount(float $lineItemAmount): self
    {
        $this->lineItemAmount = $lineItemAmount;

        return $this;
    }
}
