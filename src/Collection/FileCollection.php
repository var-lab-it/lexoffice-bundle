<?php

declare(strict_types=1);

namespace VarLabIT\LexofficeBundle\Collection;

use VarLabIT\LexofficeBundle\Entity\File;

class FileCollection extends AbstractCollection
{
    public function add(File $file): void
    {
        $this->list[] = $file;
    }
}
