<?php

declare(strict_types=1);

namespace VarLabIT\LexofficeBundle\Collection;

/** @implements \IteratorAggregate<int|string, string> */
class StringCollection extends AbstractCollection implements \IteratorAggregate
{
    /** @param array<int|string, string> $data */
    public function __construct(array $data = [])
    {
        parent::__construct();

        foreach ($data as $entry) {
            $this->add($entry);
        }
    }

    public function add(string $person): void
    {
        $this->list[] = $person;
    }
}
