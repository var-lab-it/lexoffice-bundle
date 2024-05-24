<?php

declare(strict_types=1);

namespace VarLabIT\LexofficeBundle\Collection;

use VarLabIT\LexofficeBundle\Entity\EntityInterface;

abstract class AbstractCollection
{
    /** @var array<int|string, string|AbstractCollection|EntityInterface> */
    protected array $list;

    public function __construct()
    {
        $this->list = [];
    }

    /** @return \Traversable<int|string, string|AbstractCollection|EntityInterface> */
    public function getIterator(): \Traversable
    {
        return new \ArrayIterator($this->list);
    }
}
