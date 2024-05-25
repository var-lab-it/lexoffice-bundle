<?php

declare(strict_types=1);

namespace Tests\VarLabIT\LexofficeBundle\UnitTests\Entity;

use PHPUnit\Framework\TestCase;
use VarLabIT\LexofficeBundle\Entity\ContactRole;

class ContactRoleTest extends TestCase
{
    public function testGetAndSetNumber(): void
    {
        $contactRole = new ContactRole();
        $number      = 42;

        $contactRole->setNumber($number);
        self::assertSame($number, $contactRole->getNumber());
    }
}
