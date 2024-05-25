<?php

declare(strict_types=1);

namespace Tests\VarLabIT\LexofficeBundle\UnitTests\Exception;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationList;
use VarLabIT\LexofficeBundle\Exception\ValidationException;

class ValidationExceptionTest extends TestCase
{
    public function testGetErrors(): void
    {
        $violationMock = $this->createMock(ConstraintViolation::class);
        $violationMock
            ->method('getPropertyPath')
            ->willReturn('Mocked property path');
        $violationMock
            ->method('getMessage')
            ->willReturn('Mocked violation message.');

        $errors = new ConstraintViolationList([
            $violationMock,
        ]);

        $exception = new ValidationException($errors);

        $message = $exception->getMessage();
        self::assertEquals(
            'The entity is not valid.

Mocked violation message.: Mocked property path
',
            $message,
        );

        self::assertCount(1, $exception->getErrors());
    }
}
