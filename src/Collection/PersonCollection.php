<?php

declare(strict_types=1);

namespace VarLabIT\LexofficeBundle\Collection;

use VarLabIT\LexofficeBundle\Entity\Person;

/** @implements \IteratorAggregate<array-key, Person> */
class PersonCollection extends AbstractCollection implements \IteratorAggregate
{
    public function add(Person $person): void
    {
        $this->list[] = $person;
    }
}
