<?php

declare(strict_types=1);

namespace VarLabIT\LexofficeBundle\Entity;

use VarLabIT\LexofficeBundle\Entity\Enum\TaxSubType;
use VarLabIT\LexofficeBundle\Entity\Enum\TaxType;

class TaxConditions implements EntityInterface
{
    private TaxType $taxType;
    private TaxSubType $taxSubType;
    private string $taxTypeNote;

    public function getTaxType(): TaxType
    {
        return $this->taxType;
    }

    public function setTaxType(TaxType $taxType): self
    {
        $this->taxType = $taxType;

        return $this;
    }

    public function getTaxSubType(): TaxSubType
    {
        return $this->taxSubType;
    }

    public function setTaxSubType(TaxSubType $taxSubType): self
    {
        $this->taxSubType = $taxSubType;

        return $this;
    }

    public function getTaxTypeNote(): string
    {
        return $this->taxTypeNote;
    }

    public function setTaxTypeNote(string $taxTypeNote): self
    {
        $this->taxTypeNote = $taxTypeNote;

        return $this;
    }
}
