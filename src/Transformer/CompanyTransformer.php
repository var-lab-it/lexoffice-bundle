<?php

declare(strict_types=1);

namespace VarLabIT\LexofficeBundle\Transformer;

use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use VarLabIT\LexofficeBundle\Collection\PersonCollection;
use VarLabIT\LexofficeBundle\Entity\Company;
use VarLabIT\LexofficeBundle\Entity\EntityInterface;
use VarLabIT\LexofficeBundle\Entity\Person;
use function Safe\json_decode;
use function Safe\json_encode;

class CompanyTransformer extends AbstractTransformer
{
    public function transformToObject(string $data): Company
    {
        $contactPersonsCallback = function (array $data): PersonCollection {
            $collection = new PersonCollection();

            foreach ($data as $personData) {
                $person = $this->getSerializer()->deserialize(
                    json_encode($personData),
                    Person::class,
                    'json',
                );

                $collection->add($person);
            }

            return $collection;
        };

        return $this->getSerializer()->deserialize(
            $data,
            Company::class,
            'json',
            [
                AbstractNormalizer::CALLBACKS => [
                    'contactPersons' => $contactPersonsCallback,
                ],
            ],
        );
    }

    /**
     * @return array<mixed>
     *
     * @throws \Safe\Exceptions\JsonException
     */
    public function transformFromObject(EntityInterface $entity): array
    {
        $json = $this->getSerializer()->serialize($entity, 'json');

        /** @var array<mixed> $data */
        $data = json_decode($json, true);

        return $data;
    }

    public static function getInstance(): CompanyTransformer
    {
        return new self();
    }
}
