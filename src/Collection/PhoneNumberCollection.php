<?php

declare(strict_types=1);

namespace VarLabIT\LexofficeBundle\Collection;

use VarLabIT\LexofficeBundle\Entity\Enum\PhoneNumberType;

/** @implements \IteratorAggregate<string, StringCollection> */
class PhoneNumberCollection extends AbstractCollection implements \IteratorAggregate
{
    /** @param array<string> $phoneNumbers */
    public function add(PhoneNumberType $type, array $phoneNumbers): void
    {
        $this->list[$type->value] = new StringCollection($phoneNumbers);
    }

    public function findByType(PhoneNumberType $type): ?StringCollection
    {
        if (isset($this->list[$type->value])) {
            /** @var StringCollection $value */
            $value = $this->list[$type->value];

            return $value;
        }

        return null;
    }
}
