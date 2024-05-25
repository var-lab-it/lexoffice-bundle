<?php

declare(strict_types=1);

namespace Tests\VarLabIT\LexofficeBundle\UnitTests\Entity;

use PHPUnit\Framework\TestCase;
use Safe\DateTimeImmutable;
use VarLabIT\LexofficeBundle\Collection\DownPaymentDeductionCollection;
use VarLabIT\LexofficeBundle\Collection\FileCollection;
use VarLabIT\LexofficeBundle\Collection\LineItemCollection;
use VarLabIT\LexofficeBundle\Collection\TaxAmountCollection;
use VarLabIT\LexofficeBundle\Entity\Address;
use VarLabIT\LexofficeBundle\Entity\Enum\InvoiceLanguage;
use VarLabIT\LexofficeBundle\Entity\Enum\VoucherStatus;
use VarLabIT\LexofficeBundle\Entity\Invoice;
use VarLabIT\LexofficeBundle\Entity\LineItem;
use VarLabIT\LexofficeBundle\Entity\PaymentConditions;
use VarLabIT\LexofficeBundle\Entity\ShippingConditions;
use VarLabIT\LexofficeBundle\Entity\TaxConditions;
use VarLabIT\LexofficeBundle\Entity\TotalPrice;
use VarLabIT\LexofficeBundle\Entity\XRechnungReference;

class InvoiceTest extends TestCase
{
    public function testGetAndSetId(): void
    {
        $invoice = new Invoice();
        $id      = '12345';

        $invoice->setId($id);
        self::assertSame($id, $invoice->getId());
    }

    public function testGetAndSetOrganizationId(): void
    {
        $invoice        = new Invoice();
        $organizationId = 'org123';

        $invoice->setOrganizationId($organizationId);
        self::assertSame($organizationId, $invoice->getOrganizationId());
    }

    public function testGetAndSetCreatedDate(): void
    {
        $invoice     = new Invoice();
        $createdDate = new DateTimeImmutable();

        $invoice->setCreatedDate($createdDate);
        self::assertSame($createdDate, $invoice->getCreatedDate());
    }

    public function testGetAndSetUpdatedDate(): void
    {
        $invoice     = new Invoice();
        $updatedDate = new DateTimeImmutable();

        $invoice->setUpdatedDate($updatedDate);
        self::assertSame($updatedDate, $invoice->getUpdatedDate());
    }

    public function testGetAndSetVersion(): void
    {
        $invoice = new Invoice();
        $version = 1;

        $invoice->setVersion($version);
        self::assertSame($version, $invoice->getVersion());
    }

    public function testGetAndSetLanguage(): void
    {
        $invoice  = new Invoice();
        $language = InvoiceLanguage::EN;

        $invoice->setLanguage($language);
        self::assertSame($language, $invoice->getLanguage());
    }

    public function testIsAndSetArchived(): void
    {
        $invoice  = new Invoice();
        $archived = true;

        $invoice->setArchived($archived);
        self::assertTrue($invoice->isArchived());
    }

    public function testGetAndSetVoucherStatus(): void
    {
        $invoice       = new Invoice();
        $voucherStatus = VoucherStatus::PAID;

        $invoice->setVoucherStatus($voucherStatus);
        self::assertSame($voucherStatus, $invoice->getVoucherStatus());
    }

    public function testGetAndSetVoucherNumber(): void
    {
        $invoice       = new Invoice();
        $voucherNumber = 'VN123';

        $invoice->setVoucherNumber($voucherNumber);
        self::assertSame($voucherNumber, $invoice->getVoucherNumber());
    }

    public function testGetAndSetVoucherDate(): void
    {
        $invoice     = new Invoice();
        $voucherDate = new DateTimeImmutable();

        $invoice->setVoucherDate($voucherDate);
        self::assertSame($voucherDate, $invoice->getVoucherDate());
    }

    public function testGetAndSetDueDate(): void
    {
        $invoice = new Invoice();
        $dueDate = new DateTimeImmutable();

        $invoice->setDueDate($dueDate);
        self::assertSame($dueDate, $invoice->getDueDate());
    }

    public function testGetAndSetAddress(): void
    {
        $invoice = new Invoice();
        $address = new Address();

        $invoice->setAddress($address);
        self::assertSame($address, $invoice->getAddress());
    }

    public function testGetAndSetXRechnungReference(): void
    {
        $invoice            = new Invoice();
        $xRechnungReference = new XRechnungReference();

        $invoice->setXRechnungReference($xRechnungReference);
        self::assertSame($xRechnungReference, $invoice->getXRechnungReference());
    }

    public function testGetAndSetLineItems(): void
    {
        $invoice   = new Invoice();
        $lineItems = new LineItemCollection();

        $invoice->setLineItems($lineItems);
        self::assertSame($lineItems, $invoice->getLineItems());
    }

    public function testAddLineItem(): void
    {
        $invoice  = new Invoice();
        $lineItem = new LineItem();

        $invoice->addLineItem($lineItem);
        self::assertCount(1, $invoice->getLineItems()->getIterator());
        /** @phpstan-ignore-next-line */
        self::assertSame($lineItem, $invoice->getLineItems()->getIterator()[0]);
    }

    public function testGetAndSetTotalPrice(): void
    {
        $invoice    = new Invoice();
        $totalPrice = new TotalPrice();

        $invoice->setTotalPrice($totalPrice);
        self::assertSame($totalPrice, $invoice->getTotalPrice());
    }

    public function testGetAndSetTaxAmounts(): void
    {
        $invoice    = new Invoice();
        $taxAmounts = new TaxAmountCollection();

        $invoice->setTaxAmounts($taxAmounts);
        self::assertSame($taxAmounts, $invoice->getTaxAmounts());
    }

    public function testGetAndSetTaxConditions(): void
    {
        $invoice       = new Invoice();
        $taxConditions = new TaxConditions();

        $invoice->setTaxConditions($taxConditions);
        self::assertSame($taxConditions, $invoice->getTaxConditions());
    }

    public function testGetAndSetPaymentConditions(): void
    {
        $invoice           = new Invoice();
        $paymentConditions = new PaymentConditions();

        $invoice->setPaymentConditions($paymentConditions);
        self::assertSame($paymentConditions, $invoice->getPaymentConditions());
    }

    public function testGetAndSetShippingConditions(): void
    {
        $invoice            = new Invoice();
        $shippingConditions = new ShippingConditions();

        $invoice->setShippingConditions($shippingConditions);
        self::assertSame($shippingConditions, $invoice->getShippingConditions());
    }

    public function testIsAndSetClosingInvoice(): void
    {
        $invoice        = new Invoice();
        $closingInvoice = true;

        $invoice->setClosingInvoice($closingInvoice);
        self::assertTrue($invoice->isClosingInvoice());
    }

    public function testGetAndSetClaimedGrossAmount(): void
    {
        $invoice            = new Invoice();
        $claimedGrossAmount = 123.45;

        $invoice->setClaimedGrossAmount($claimedGrossAmount);
        self::assertSame($claimedGrossAmount, $invoice->getClaimedGrossAmount());
    }

    public function testGetAndSetDownPaymentDeductions(): void
    {
        $invoice               = new Invoice();
        $downPaymentDeductions = new DownPaymentDeductionCollection();

        $invoice->setDownPaymentDeductions($downPaymentDeductions);
        self::assertSame($downPaymentDeductions, $invoice->getDownPaymentDeductions());
    }

    public function testGetAndSetRecurringTemplateId(): void
    {
        $invoice             = new Invoice();
        $recurringTemplateId = 'template123';

        $invoice->setRecurringTemplateId($recurringTemplateId);
        self::assertSame($recurringTemplateId, $invoice->getRecurringTemplateId());
    }

    public function testGetAndSetTitle(): void
    {
        $invoice = new Invoice();
        $title   = 'Test Title';

        $invoice->setTitle($title);
        self::assertSame($title, $invoice->getTitle());
    }

    public function testGetAndSetIntroduction(): void
    {
        $invoice      = new Invoice();
        $introduction = 'This is an introduction.';

        $invoice->setIntroduction($introduction);
        self::assertSame($introduction, $invoice->getIntroduction());
    }

    public function testGetAndSetRemark(): void
    {
        $invoice = new Invoice();
        $remark  = 'This is a remark.';

        $invoice->setRemark($remark);
        self::assertSame($remark, $invoice->getRemark());
    }

    public function testGetAndSetFiles(): void
    {
        $invoice = new Invoice();
        $files   = new FileCollection();

        $invoice->setFiles($files);
        self::assertSame($files, $invoice->getFiles());
    }
}
