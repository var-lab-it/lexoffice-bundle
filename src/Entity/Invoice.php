<?php

declare(strict_types=1);

namespace VarLabIT\LexofficeBundle\Entity;

use Safe\DateTimeImmutable;
use Symfony\Component\Validator\Constraints\NotBlank;
use VarLabIT\LexofficeBundle\Collection\DownPaymentDeductionCollection;
use VarLabIT\LexofficeBundle\Collection\FileCollection;
use VarLabIT\LexofficeBundle\Collection\LineItemCollection;
use VarLabIT\LexofficeBundle\Collection\TaxAmountCollection;
use VarLabIT\LexofficeBundle\Entity\Enum\InvoiceLanguage;
use VarLabIT\LexofficeBundle\Entity\Enum\VoucherStatus;

class Invoice implements EntityInterface
{
    private string $id;
    private string $organizationId;
    private DateTimeImmutable $createdDate;
    private DateTimeImmutable $updatedDate;
    private int $version;
    private InvoiceLanguage $language;
    private bool $archived;
    private VoucherStatus $voucherStatus;
    private string $voucherNumber;

    #[NotBlank]
    private DateTimeImmutable $voucherDate;
    private DateTimeImmutable $dueDate;
    private Address $address;
    private XRechnungReference $XRechnungReference;
    private LineItemCollection $lineItems;
    private TotalPrice $totalPrice;
    private TaxAmountCollection $taxAmounts;
    private TaxConditions $taxConditions;
    private PaymentConditions $paymentConditions;
    private ShippingConditions $shippingConditions;
    private bool $closingInvoice;
    private float $claimedGrossAmount;
    private DownPaymentDeductionCollection $downPaymentDeductions;
    private string $recurringTemplateId;
    private string $title;
    private string $introduction;
    private string $remark;
    private FileCollection $files;

    public function __construct()
    {
        $this->lineItems             = new LineItemCollection();
        $this->taxAmounts            = new TaxAmountCollection();
        $this->downPaymentDeductions = new DownPaymentDeductionCollection();
        $this->files                 = new FileCollection();
    }

    public function addLineItem(LineItem $lineItem): self
    {
        $this->lineItems->add($lineItem);

        return $this;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getOrganizationId(): string
    {
        return $this->organizationId;
    }

    public function setOrganizationId(string $organizationId): self
    {
        $this->organizationId = $organizationId;

        return $this;
    }

    public function getCreatedDate(): DateTimeImmutable
    {
        return $this->createdDate;
    }

    public function setCreatedDate(DateTimeImmutable $createdDate): self
    {
        $this->createdDate = $createdDate;

        return $this;
    }

    public function getUpdatedDate(): DateTimeImmutable
    {
        return $this->updatedDate;
    }

    public function setUpdatedDate(DateTimeImmutable $updatedDate): self
    {
        $this->updatedDate = $updatedDate;

        return $this;
    }

    public function getVersion(): int
    {
        return $this->version;
    }

    public function setVersion(int $version): self
    {
        $this->version = $version;

        return $this;
    }

    public function getLanguage(): InvoiceLanguage
    {
        return $this->language;
    }

    public function setLanguage(InvoiceLanguage $language): self
    {
        $this->language = $language;

        return $this;
    }

    public function isArchived(): bool
    {
        return $this->archived;
    }

    public function setArchived(bool $archived): self
    {
        $this->archived = $archived;

        return $this;
    }

    public function getVoucherStatus(): VoucherStatus
    {
        return $this->voucherStatus;
    }

    public function setVoucherStatus(VoucherStatus $voucherStatus): self
    {
        $this->voucherStatus = $voucherStatus;

        return $this;
    }

    public function getVoucherNumber(): string
    {
        return $this->voucherNumber;
    }

    public function setVoucherNumber(string $voucherNumber): self
    {
        $this->voucherNumber = $voucherNumber;

        return $this;
    }

    public function getVoucherDate(): DateTimeImmutable
    {
        return $this->voucherDate;
    }

    public function setVoucherDate(DateTimeImmutable $voucherDate): self
    {
        $this->voucherDate = $voucherDate;

        return $this;
    }

    public function getDueDate(): DateTimeImmutable
    {
        return $this->dueDate;
    }

    public function setDueDate(DateTimeImmutable $dueDate): self
    {
        $this->dueDate = $dueDate;

        return $this;
    }

    public function getAddress(): Address
    {
        return $this->address;
    }

    public function setAddress(Address $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getXRechnungReference(): XRechnungReference
    {
        return $this->XRechnungReference;
    }

    public function setXRechnungReference(XRechnungReference $XRechnungReference): self
    {
        $this->XRechnungReference = $XRechnungReference;

        return $this;
    }

    public function getLineItems(): LineItemCollection
    {
        return $this->lineItems;
    }

    public function setLineItems(LineItemCollection $lineItems): self
    {
        $this->lineItems = $lineItems;

        return $this;
    }

    public function getTotalPrice(): TotalPrice
    {
        return $this->totalPrice;
    }

    public function setTotalPrice(TotalPrice $totalPrice): self
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    public function getTaxAmounts(): TaxAmountCollection
    {
        return $this->taxAmounts;
    }

    public function setTaxAmounts(TaxAmountCollection $taxAmounts): self
    {
        $this->taxAmounts = $taxAmounts;

        return $this;
    }

    public function getTaxConditions(): TaxConditions
    {
        return $this->taxConditions;
    }

    public function setTaxConditions(TaxConditions $taxConditions): self
    {
        $this->taxConditions = $taxConditions;

        return $this;
    }

    public function getPaymentConditions(): PaymentConditions
    {
        return $this->paymentConditions;
    }

    public function setPaymentConditions(PaymentConditions $paymentConditions): self
    {
        $this->paymentConditions = $paymentConditions;

        return $this;
    }

    public function getShippingConditions(): ShippingConditions
    {
        return $this->shippingConditions;
    }

    public function setShippingConditions(ShippingConditions $shippingConditions): self
    {
        $this->shippingConditions = $shippingConditions;

        return $this;
    }

    public function isClosingInvoice(): bool
    {
        return $this->closingInvoice;
    }

    public function setClosingInvoice(bool $closingInvoice): self
    {
        $this->closingInvoice = $closingInvoice;

        return $this;
    }

    public function getClaimedGrossAmount(): float
    {
        return $this->claimedGrossAmount;
    }

    public function setClaimedGrossAmount(float $claimedGrossAmount): self
    {
        $this->claimedGrossAmount = $claimedGrossAmount;

        return $this;
    }

    public function getDownPaymentDeductions(): DownPaymentDeductionCollection
    {
        return $this->downPaymentDeductions;
    }

    public function setDownPaymentDeductions(DownPaymentDeductionCollection $downPaymentDeductions): self
    {
        $this->downPaymentDeductions = $downPaymentDeductions;

        return $this;
    }

    public function getRecurringTemplateId(): string
    {
        return $this->recurringTemplateId;
    }

    public function setRecurringTemplateId(string $recurringTemplateId): self
    {
        $this->recurringTemplateId = $recurringTemplateId;

        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getIntroduction(): string
    {
        return $this->introduction;
    }

    public function setIntroduction(string $introduction): self
    {
        $this->introduction = $introduction;

        return $this;
    }

    public function getRemark(): string
    {
        return $this->remark;
    }

    public function setRemark(string $remark): self
    {
        $this->remark = $remark;

        return $this;
    }

    public function getFiles(): FileCollection
    {
        return $this->files;
    }

    public function setFiles(FileCollection $files): self
    {
        $this->files = $files;

        return $this;
    }
}
