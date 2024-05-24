<?php

declare(strict_types=1);

namespace VarLabIT\LexofficeBundle\Transformer;

use Safe\DateTimeImmutable;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use VarLabIT\LexofficeBundle\Collection\DownPaymentDeductionCollection;
use VarLabIT\LexofficeBundle\Collection\FileCollection;
use VarLabIT\LexofficeBundle\Collection\LineItemCollection;
use VarLabIT\LexofficeBundle\Collection\TaxAmountCollection;
use VarLabIT\LexofficeBundle\Entity\Address;
use VarLabIT\LexofficeBundle\Entity\EntityInterface;
use VarLabIT\LexofficeBundle\Entity\Enum\Currency;
use VarLabIT\LexofficeBundle\Entity\Enum\InvoiceLanguage;
use VarLabIT\LexofficeBundle\Entity\Enum\LineItemType;
use VarLabIT\LexofficeBundle\Entity\Enum\ShippingType;
use VarLabIT\LexofficeBundle\Entity\Enum\TaxSubType;
use VarLabIT\LexofficeBundle\Entity\Enum\TaxType;
use VarLabIT\LexofficeBundle\Entity\Enum\VoucherStatus;
use VarLabIT\LexofficeBundle\Entity\File;
use VarLabIT\LexofficeBundle\Entity\Invoice;
use VarLabIT\LexofficeBundle\Entity\LineItem;
use VarLabIT\LexofficeBundle\Entity\PaymentConditions;
use VarLabIT\LexofficeBundle\Entity\PaymentDiscountConditions;
use VarLabIT\LexofficeBundle\Entity\ShippingConditions;
use VarLabIT\LexofficeBundle\Entity\TaxAmount;
use VarLabIT\LexofficeBundle\Entity\TaxConditions;
use VarLabIT\LexofficeBundle\Entity\TotalPrice;
use VarLabIT\LexofficeBundle\Entity\UnitPrice;
use function Safe\json_decode;
use function Safe\json_encode;

class InvoiceTransformer extends AbstractTransformer
{
    public function transformToObject(string $data): Invoice
    {
        $dateTimeCallback = static function (string $data): DateTimeImmutable {
            return new DateTimeImmutable($data);
        };

        $addressCallback = function (array $address): Address {
            return $this->getSerializer()->deserialize(json_encode($address), Address::class, 'json');
        };

        $currencyCallback = static function (string $rawType): Currency {
            return Currency::from($rawType);
        };

        $lineItemsCallback = function (array $data) use ($currencyCallback): LineItemCollection {
            $collection = new LineItemCollection();

            foreach ($data as $lineItemData) {
                $lineItem = $this->getSerializer()->deserialize(
                    json_encode($lineItemData),
                    LineItem::class,
                    'json',
                    [
                        AbstractNormalizer::CALLBACKS => [
                            'type'      => static function (string $rawType): LineItemType {
                                return LineItemType::from($rawType);
                            },
                            'unitPrice' => function (array $data) use ($currencyCallback): UnitPrice {
                                return $this->getSerializer()->deserialize(
                                    json_encode($data),
                                    UnitPrice::class,
                                    'json',
                                    [
                                        AbstractNormalizer::CALLBACKS => [
                                            'currency' => $currencyCallback,
                                        ],
                                    ],
                                );
                            },
                        ],
                    ],
                );

                $collection->add($lineItem);
            }

            return $collection;
        };

        $totalPriceCallback = function (array $data) use ($currencyCallback): TotalPrice {
            return $this->getSerializer()->deserialize(json_encode($data), TotalPrice::class, 'json', [
                AbstractNormalizer::CALLBACKS => [
                    'currency' => $currencyCallback,
                ],
            ]);
        };

        $taxConditionsCallback = function (array $data): TaxConditions {
            return $this->getSerializer()->deserialize(json_encode($data), TaxConditions::class, 'json', [
                AbstractNormalizer::CALLBACKS => [
                    'taxType'    => static function (string $data): TaxType {
                        return TaxType::from($data);
                    },
                    'taxSubType' => static function (string $data): TaxSubType {
                        return TaxSubType::from($data);
                    },
                ],
            ]);
        };

        $paymentConditionsCallback = function (array $data): PaymentConditions {
            return $this->getSerializer()->deserialize(json_encode($data), PaymentConditions::class, 'json', [
                AbstractNormalizer::CALLBACKS => [
                    'paymentDiscountConditions' => function (array $data): PaymentDiscountConditions {
                        return $this->getSerializer()->deserialize(
                            json_encode($data),
                            PaymentDiscountConditions::class,
                            'json',
                        );
                    },
                ],
            ]);
        };

        $shippingConditionsCallback = function (array $data) use ($dateTimeCallback): ShippingConditions {
            return $this->getSerializer()->deserialize(json_encode($data), ShippingConditions::class, 'json', [
                AbstractNormalizer::CALLBACKS => [
                    'shippingDate'    => $dateTimeCallback,
                    'shippingEndDate' => $dateTimeCallback,
                    'shippingType'    => static function (string $data): ShippingType {
                        return ShippingType::from($data);
                    },
                ],
            ]);
        };

        $languageCallback = static function (string $data): InvoiceLanguage {
            return InvoiceLanguage::from($data);
        };

        $voucherStatusCallback = static function (string $data): VoucherStatus {
            return VoucherStatus::from($data);
        };

        $taxAmountsCallback = function (array $data): TaxAmountCollection {
            $collection = new TaxAmountCollection();

            foreach ($data as $taxAmountData) {
                $taxAmount = $this->getSerializer()->deserialize(json_encode($taxAmountData), TaxAmount::class, 'json');

                $collection->add($taxAmount);
            }

            return $collection;
        };

        $filesCallback = static function (array $data): FileCollection {
            $collection = new FileCollection();

            foreach ($data as $item) {
                $file = new File();
                $file->setDocumentFileId($item);

                $collection->add($file);
            }

            return $collection;
        };

        return $this->getSerializer()->deserialize(
            $data,
            Invoice::class,
            'json',
            [
                AbstractNormalizer::CALLBACKS => [
                    'createdDate'        => $dateTimeCallback,
                    'updatedDate'        => $dateTimeCallback,
                    'voucherDate'        => $dateTimeCallback,
                    'dueDate'            => $dateTimeCallback,
                    'address'            => $addressCallback,
                    'lineItems'          => $lineItemsCallback,
                    'totalPrice'         => $totalPriceCallback,
                    'taxConditions'      => $taxConditionsCallback,
                    'paymentConditions'  => $paymentConditionsCallback,
                    'shippingConditions' => $shippingConditionsCallback,
                    'language'           => $languageCallback,
                    'voucherStatus'      => $voucherStatusCallback,
                    'taxAmounts'         => $taxAmountsCallback,
                    'files'              => $filesCallback,
                ],
            ],
        );
    }

    /** @inheritDoc */
    public function transformFromObject(EntityInterface $entity): array
    {
        $dateTimeCallback = static function (DateTimeImmutable $dateTime): string {
            return $dateTime->format('Y-m-d') . 'T00:00:00.000+02:00';
        };

        $currencyCallback = static function (Currency $currency): string {
            return $currency->value;
        };

        $lineItemsCallback = function (LineItemCollection $lineItemCollection) use ($currencyCallback): array {
            $data = [];

            foreach ($lineItemCollection->getIterator() as $lineItem) {
                $json = $this->getSerializer()->serialize($lineItem, 'json', [
                    AbstractNormalizer::CALLBACKS => [
                        'type'      => static function (LineItemType $type): string {
                            return $type->value;
                        },
                        'unitPrice' => function (UnitPrice $unitPrice) use ($currencyCallback): array {
                            $json = $this->getSerializer()->serialize($unitPrice, 'json', [
                                AbstractNormalizer::CALLBACKS => [
                                    'currency' => $currencyCallback,
                                ],
                            ]);

                            /** @var array<mixed> $data */
                            $data = json_decode($json, true);

                            return $data;
                        },
                    ],
                ]);

                $data[] = json_decode($json, true);
            }

            return $data;
        };

        $totalPriceCallback = function (TotalPrice $totalPrice) use ($currencyCallback): array {
            $json = $this->getSerializer()->serialize($totalPrice, 'json', [
                AbstractNormalizer::CALLBACKS => [
                    'currency' => $currencyCallback,
                ],
            ]);

            /** @var array<mixed> $data */
            $data = json_decode($json, true);

            return $data;
        };

        $voucherStatusCallback = static function (VoucherStatus $voucherStatus): string {
            return $voucherStatus->value;
        };

        $taxAmountsCallback = function (TaxAmountCollection $taxAmountCollection): array {
            $data = [];

            foreach ($taxAmountCollection->getIterator() as $item) {
                $json = $this->getSerializer()->serialize($item, 'json');

                $data[] = json_decode($json, true);
            }

            return $data;
        };

        $taxConditionsCallback = function (TaxConditions $taxConditions): array {
            $json = $this->getSerializer()->serialize($taxConditions, 'json', [
                AbstractNormalizer::CALLBACKS => [
                    'taxType'    => static function (TaxType $taxType): string {
                        return $taxType->value;
                    },
                    'taxSubType' => static function (TaxSubType $taxType): string {
                        return $taxType->value;
                    },
                ],
            ]);

            /** @var array<mixed> $data */
            $data = json_decode($json, true);

            return $data;
        };

        $shippingConditionsCallback = function (ShippingConditions $shippingConditions) use ($dateTimeCallback): array {
            $json = $this->getSerializer()->serialize($shippingConditions, 'json', [
                AbstractNormalizer::CALLBACKS => [
                    'shippingDate'    => $dateTimeCallback,
                    'shippingEndDate' => $dateTimeCallback,
                    'shippingType'    => static function (ShippingType $shippingType): string {
                        return $shippingType->value;
                    },
                ],
            ]);

            /** @var array<mixed> $data */
            $data = json_decode($json, true);

            return $data;
        };

        $downPaymentDeductionsCallback = function (
            DownPaymentDeductionCollection $downPaymentDeductionCollection,
        ) use ($dateTimeCallback): array {
            $data = [];

            foreach ($downPaymentDeductionCollection->getIterator() as $item) {
                $json = $this->getSerializer()->serialize($item, 'json', [
                    AbstractNormalizer::CALLBACKS => [
                        'voucherDate' => $dateTimeCallback,
                    ],
                ]);

                $data[] = json_decode($json, true);
            }

            return $data;
        };

        $filesCallback = function (FileCollection $fileCollection): array {
            $data = [];

            foreach ($fileCollection->getIterator() as $item) {
                $json = $this->getSerializer()->serialize($item, 'json');

                $data[] = json_decode($json, true);
            }

            return $data;
        };

        $json = $this->getSerializer()->serialize(
            $entity,
            'json',
            [
                AbstractNormalizer::CALLBACKS => [
                    'createdDate'           => $dateTimeCallback,
                    'updatedDate'           => $dateTimeCallback,
                    'voucherDate'           => $dateTimeCallback,
                    'dueDate'               => $dateTimeCallback,
                    'lineItems'             => $lineItemsCallback,
                    'totalPrice'            => $totalPriceCallback,
                    'voucherStatus'         => $voucherStatusCallback,
                    'taxAmounts'            => $taxAmountsCallback,
                    'taxConditions'         => $taxConditionsCallback,
                    'shippingConditions'    => $shippingConditionsCallback,
                    'downPaymentDeductions' => $downPaymentDeductionsCallback,
                    'files'                 => $filesCallback,
                ],
            ],
        );

        /** @var array<mixed> $data */
        $data = json_decode($json, true);

        return $data;
    }

    public static function getInstance(): InvoiceTransformer
    {
        return new self();
    }
}
