<?php

declare(strict_types=1);

namespace Tests\VarLabIT\LexofficeBundle\UnitTests\Entity;

use PHPUnit\Framework\TestCase;
use Safe\DateTime;
use VarLabIT\LexofficeBundle\Entity\DownPaymentDeduction;

class DownPaymentDeductionTest extends TestCase
{
    public function testGetAndSetId(): void
    {
        $deduction = new DownPaymentDeduction();
        $id        = '12345';

        $deduction->setId($id);
        self::assertSame($id, $deduction->getId());
    }

    public function testGetAndSetVoucherType(): void
    {
        $deduction   = new DownPaymentDeduction();
        $voucherType = 'invoice';

        $deduction->setVoucherType($voucherType);
        self::assertSame($voucherType, $deduction->getVoucherType());
    }

    public function testGetAndSetTitle(): void
    {
        $deduction = new DownPaymentDeduction();
        $title     = 'Down Payment';

        $deduction->setTitle($title);
        self::assertSame($title, $deduction->getTitle());
    }

    public function testGetAndSetVoucherNumber(): void
    {
        $deduction     = new DownPaymentDeduction();
        $voucherNumber = 'INV-12345';

        $deduction->setVoucherNumber($voucherNumber);
        self::assertSame($voucherNumber, $deduction->getVoucherNumber());
    }

    public function testGetAndSetVoucherDate(): void
    {
        $deduction   = new DownPaymentDeduction();
        $voucherDate = new DateTime('2023-05-01');

        $deduction->setVoucherDate($voucherDate);
        self::assertSame($voucherDate, $deduction->getVoucherDate());
    }

    public function testGetAndSetReceivedGrossAmount(): void
    {
        $deduction           = new DownPaymentDeduction();
        $receivedGrossAmount = 1000.00;

        $deduction->setReceivedGrossAmount($receivedGrossAmount);
        self::assertSame($receivedGrossAmount, $deduction->getReceivedGrossAmount());
    }

    public function testGetAndSetReceivedNetAmount(): void
    {
        $deduction         = new DownPaymentDeduction();
        $receivedNetAmount = 800.00;

        $deduction->setReceivedNetAmount($receivedNetAmount);
        self::assertSame($receivedNetAmount, $deduction->getReceivedNetAmount());
    }

    public function testGetAndSetReceivedTaxAmount(): void
    {
        $deduction         = new DownPaymentDeduction();
        $receivedTaxAmount = 200.00;

        $deduction->setReceivedTaxAmount($receivedTaxAmount);
        self::assertSame($receivedTaxAmount, $deduction->getReceivedTaxAmount());
    }

    public function testGetAndSetTaxRatePercentage(): void
    {
        $deduction         = new DownPaymentDeduction();
        $taxRatePercentage = 20.0;

        $deduction->setTaxRatePercentage($taxRatePercentage);
        self::assertSame($taxRatePercentage, $deduction->getTaxRatePercentage());
    }
}
