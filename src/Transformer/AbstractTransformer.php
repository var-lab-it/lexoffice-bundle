<?php

declare(strict_types=1);

namespace VarLabIT\LexofficeBundle\Transformer;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use VarLabIT\LexofficeBundle\Entity\EntityInterface;

abstract class AbstractTransformer
{
    abstract public function transformToObject(string $data): EntityInterface;

    /** @return array<mixed> */
    abstract public function transformFromObject(EntityInterface $entity): array;

    abstract public static function getInstance(): self;

    protected function getSerializer(): Serializer
    {
        $encoders    = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];

        return new Serializer($normalizers, $encoders);
    }
}
