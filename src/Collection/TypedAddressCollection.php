<?php

declare(strict_types=1);

namespace VarLabIT\LexofficeBundle\Collection;

use VarLabIT\LexofficeBundle\Entity\Enum\AddressType;

/** @implements \IteratorAggregate<string, AddressCollection> */
class TypedAddressCollection extends AbstractCollection implements \IteratorAggregate
{
    public function add(AddressType $type, AddressCollection $addresses): void
    {
        $this->list[$type->value] = $addresses;
    }

    public function findByType(AddressType $type): ?AddressCollection
    {
        if (isset($this->list[$type->value])) {
            /** @var AddressCollection $value */
            $value = $this->list[$type->value];

            return $value;
        }

        $this->list[$type->value] = new AddressCollection();

        return $this->list[$type->value]; // @phpstan-ignore-line
    }
}
