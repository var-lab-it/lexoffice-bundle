<?php

declare(strict_types=1);

namespace VarLabIT\LexofficeBundle\Collection;

use VarLabIT\LexofficeBundle\Entity\ContactRole;
use VarLabIT\LexofficeBundle\Entity\Enum\RoleType;

/** @implements \IteratorAggregate<string, ContactRole> */
class RoleCollection extends AbstractCollection implements \IteratorAggregate
{
    public function add(RoleType $type, ContactRole $role): void
    {
        $this->list[$type->value] = $role;
    }

    public function findByType(RoleType $type): ?ContactRole
    {
        if (isset($this->list[$type->value])) {
            /** @var ContactRole $value */
            $value = $this->list[$type->value];

            return $value;
        }

        return null;
    }
}
