<?php

declare(strict_types=1);

namespace VarLabIT\LexofficeBundle\Collection;

use VarLabIT\LexofficeBundle\Entity\Enum\EmailAddressType;

/** @implements \IteratorAggregate<string, StringCollection> */
class EmailAddressCollection extends AbstractCollection implements \IteratorAggregate
{
    /** @param array<string> $emailAddresses */
    public function add(EmailAddressType $type, array $emailAddresses): void
    {
        $this->list[$type->value] = new StringCollection($emailAddresses);
    }

    public function findByType(EmailAddressType $type): ?StringCollection
    {
        if (isset($this->list[$type->value])) {
            /** @var StringCollection $value */
            $value = $this->list[$type->value];

            return $value;
        }

        return null;
    }
}
