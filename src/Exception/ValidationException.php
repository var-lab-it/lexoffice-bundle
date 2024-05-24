<?php

declare(strict_types=1);

namespace VarLabIT\LexofficeBundle\Exception;

use Symfony\Component\Validator\ConstraintViolationListInterface;

class ValidationException extends \Exception
{
    public function __construct(
        private readonly ConstraintViolationListInterface $errors,
        int $code = 0,
        ?\Throwable $previous = null,
    ) {
        $message = "The entity is not valid.\n\n";

        foreach ($this->errors as $error) {
            $message .= $error->getMessage() . ": {$error->getPropertyPath()}\n";
        }

        parent::__construct($message, $code, $previous);
    }

    public function getErrors(): ConstraintViolationListInterface
    {
        return $this->errors;
    }
}
