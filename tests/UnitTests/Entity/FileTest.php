<?php

declare(strict_types=1);

namespace Tests\VarLabIT\LexofficeBundle\UnitTests\Entity;

use PHPUnit\Framework\TestCase;
use VarLabIT\LexofficeBundle\Entity\File;

class FileTest extends TestCase
{
    public function testGetAndSetDocumentFileId(): void
    {
        $file           = new File();
        $documentFileId = 'file123';

        $file->setDocumentFileId($documentFileId);
        self::assertSame($documentFileId, $file->getDocumentFileId());
    }
}
