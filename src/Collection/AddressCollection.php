<?php

declare(strict_types=1);

namespace VarLabIT\LexofficeBundle\Collection;

use VarLabIT\LexofficeBundle\Entity\Address;

/** @implements \IteratorAggregate<Address> */
class AddressCollection extends AbstractCollection implements \IteratorAggregate
{
    /** @param array<Address> $addresses */
    public function __construct(array $addresses = [])
    {
        parent::__construct();

        foreach ($addresses as $address) {
            /** @phpstan-ignore-next-line */
            if (!($address instanceof Address)) {
                continue;
            }

            $this->add($address);
        }
    }

    public function add(Address $address): void
    {
        $this->list[] = $address;
    }
}
