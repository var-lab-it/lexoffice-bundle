<?php

declare(strict_types=1);

namespace VarLabIT\LexofficeBundle\Transformer;

use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use VarLabIT\LexofficeBundle\Collection\AddressCollection;
use VarLabIT\LexofficeBundle\Collection\EmailAddressCollection;
use VarLabIT\LexofficeBundle\Collection\PhoneNumberCollection;
use VarLabIT\LexofficeBundle\Collection\RoleCollection;
use VarLabIT\LexofficeBundle\Collection\TypedAddressCollection;
use VarLabIT\LexofficeBundle\Entity\Address;
use VarLabIT\LexofficeBundle\Entity\Company;
use VarLabIT\LexofficeBundle\Entity\Contact;
use VarLabIT\LexofficeBundle\Entity\ContactRole;
use VarLabIT\LexofficeBundle\Entity\EntityInterface;
use VarLabIT\LexofficeBundle\Entity\Enum\AddressType;
use VarLabIT\LexofficeBundle\Entity\Enum\EmailAddressType;
use VarLabIT\LexofficeBundle\Entity\Enum\PhoneNumberType;
use VarLabIT\LexofficeBundle\Entity\Enum\RoleType;
use VarLabIT\LexofficeBundle\Entity\XRechnungReference;
use function Safe\json_encode;
use function Safe\json_decode;

class ContactTransformer extends AbstractTransformer
{
    public function transformToObject(string $data): Contact
    {
        $rolesCallback = static function (array $data): RoleCollection {
            $collection = new RoleCollection();

            foreach ($data as $type => $role) {
                $roleObject = new ContactRole();
                $roleObject
                    ->setNumber($role['number']);

                $collection->add(RoleType::from($type), $roleObject);
            }

            return $collection;
        };

        $companyCallback = static function (array $data): Company {
            return CompanyTransformer::getInstance()->transformToObject(json_encode($data));
        };

        $xRechnungCallback = function (array $innerObject): XRechnungReference {
            return $this->getSerializer()->deserialize(
                json_encode($innerObject),
                XRechnungReference::class,
                'json',
            );
        };

        $emailAddressesCallback = static function (array $data): EmailAddressCollection {
            $collection = new EmailAddressCollection();

            foreach ($data as $type => $emailAddress) {
                $collection->add(EmailAddressType::from($type), $emailAddress);
            }

            return $collection;
        };

        $phoneNumbersCallback = static function (array $data): PhoneNumberCollection {
            $collection = new PhoneNumberCollection();

            foreach ($data as $type => $phoneNumbers) {
                $collection->add(PhoneNumberType::from($type), $phoneNumbers);
            }

            return $collection;
        };

        $addressesCallback = function (array $data): TypedAddressCollection {
            $collection = new TypedAddressCollection();

            foreach ($data as $type => $addresses) {
                $addressCollection = new AddressCollection();

                foreach ($addresses as $address) {
                    $addressEntity = $this->getSerializer()->deserialize(json_encode($address), Address::class, 'json');

                    $addressCollection->add($addressEntity);
                }

                $collection->add(AddressType::from($type), $addressCollection);
            }

            return $collection;
        };

        return $this->getSerializer()->deserialize(
            $data,
            Contact::class,
            'json',
            [
                AbstractNormalizer::CALLBACKS => [
                    'roles'          => $rolesCallback,
                    'company'        => $companyCallback,
                    'xRechnung'      => $xRechnungCallback,
                    'emailAddresses' => $emailAddressesCallback,
                    'phoneNumbers'   => $phoneNumbersCallback,
                    'addresses'      => $addressesCallback,
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
        $json = $this->getSerializer()->serialize(
            $entity,
            'json',
            [
                AbstractNormalizer::CALLBACKS => [
                ],
            ],
        );

        /** @var array<mixed> $data */
        $data = json_decode($json, true);

        /** @var array<mixed> $roles */
        $roles = $data['roles'];

        foreach ($roles as $key => $value) {
            $data['roles'][$key] = new \ArrayObject();
        }

        return $data;
    }

    public static function getInstance(): ContactTransformer
    {
        return new self();
    }
}
