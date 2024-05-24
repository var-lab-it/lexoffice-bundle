<?php

declare(strict_types=1);

namespace VarLabIT\LexofficeBundle\Entity;

class ContactRole implements EntityInterface
{
    private int $number;

    public function getNumber(): int
    {
        return $this->number;
    }

    public function setNumber(int $number): self
    {
        $this->number = $number;

        return $this;
    }
}
