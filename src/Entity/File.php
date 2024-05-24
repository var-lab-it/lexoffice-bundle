<?php

declare(strict_types=1);

namespace VarLabIT\LexofficeBundle\Entity;

class File implements EntityInterface
{
    private string $documentFileId;

    public function getDocumentFileId(): string
    {
        return $this->documentFileId;
    }

    public function setDocumentFileId(string $documentFileId): self
    {
        $this->documentFileId = $documentFileId;

        return $this;
    }
}
