<?php

declare(strict_types=1);

namespace Tests\VarLabIT\LexofficeBundle\UnitTests;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Spatie\Snapshots\MatchesSnapshots;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;
use VarLabIT\LexofficeBundle\Entity\Address;
use VarLabIT\LexofficeBundle\Entity\Company;
use VarLabIT\LexofficeBundle\Entity\Contact;
use VarLabIT\LexofficeBundle\Entity\Enum\AddressType;
use VarLabIT\LexofficeBundle\Entity\Enum\Currency;
use VarLabIT\LexofficeBundle\Entity\Enum\LineItemType;
use VarLabIT\LexofficeBundle\Entity\Invoice;
use VarLabIT\LexofficeBundle\Entity\LineItem;
use VarLabIT\LexofficeBundle\Entity\Person;
use VarLabIT\LexofficeBundle\Entity\UnitPrice;
use VarLabIT\LexofficeBundle\Exception\ValidationException;
use VarLabIT\LexofficeBundle\LexofficeClient;
use VarLabIT\LexofficeBundle\Transformer\ContactTransformer;
use VarLabIT\LexofficeBundle\Transformer\InvoiceTransformer;
use function Safe\file_get_contents;
use function Safe\json_encode;

class LexofficeClientTest extends TestCase
{
    use MatchesSnapshots;

    private HttpClientInterface&MockObject $httpClientMock;
    private ValidatorInterface&MockObject $validatorMock;
    private Filesystem&MockObject $filesystemMock;

    protected function setUp(): void
    {
        $this->httpClientMock = $this->createMock(HttpClientInterface::class);
        $this->validatorMock  = $this->createMock(ValidatorInterface::class);
        $this->filesystemMock = $this->createMock(Filesystem::class);
    }

    public function testCreateInvoiceSucceeds(): void
    {
        $responseMock = $this->createMock(ResponseInterface::class);
        $responseMock
            ->method('getContent')
            ->willReturn(json_encode([
                'id' => 'lexoffice-id',
            ]));

        $this->httpClientMock
            ->method('request')
            ->willReturn($responseMock);

        $invoice = new Invoice();
        $invoice
            ->setId('lexoffice-id')
            ->setTitle('Invoice')
            ->setAddress(
                (new Address())
                    ->setCity('Nürnberg')
                    ->setCountryCode('DE'),
            )
            ->setRemark('Thank you!')
            ->addLineItem(
                (new LineItem())
                    ->setId('lexoffice-id')
                    ->setName('Software development')
                    ->setQuantity(100)
                    ->setType(LineItemType::SERVICE)
                    ->setDescription('Creating a nice software.')
                    ->setUnitPrice(
                        (new UnitPrice())
                            ->setCurrency(Currency::EUR)
                            ->setTaxRatePercentage(19)
                            ->setNetAmount(120)
                            ->setGrossAmount(120 * 1.19),
                    ),
            );

        $client = $this->getClient();

        $result = $client->createInvoice($invoice);

        $resultArray = InvoiceTransformer::getInstance()->transformFromObject($result);

        self::assertMatchesJsonSnapshot($resultArray);
    }

    public function testCreateInvoiceValidationErrors(): void
    {
        $constraintsMock = $this->createMock(ConstraintViolationListInterface::class);
        $constraintsMock
            ->method('count')
            ->willReturn(10);

        $this->validatorMock
            ->method('validate')
            ->willReturn($constraintsMock);

        $client = $this->getClient();

        self::expectException(ValidationException::class);
        $client->createInvoice(new Invoice());
    }

    public function testFetchInvoice(): void
    {
        $responseMock = $this->createMock(ResponseInterface::class);
        $responseMock
            ->method('getContent')
            ->willReturn(file_get_contents(__DIR__ . '/Transformer/mocks/invoice_1.json'));

        $this->httpClientMock
            ->method('request')
            ->willReturn($responseMock);

        $client = $this->getClient();

        /** @var Invoice $result */
        $result = $client->fetchInvoice('e9066f04-8cc7-4616-93f8-ac9ecc8479c8');

        $resultArray = InvoiceTransformer::getInstance()->transformFromObject($result);

        self::assertMatchesJsonSnapshot($resultArray);
    }

    public function testCreateContact(): void
    {
        $responseMock = $this->createMock(ResponseInterface::class);
        $responseMock
            ->method('getContent')
            ->willReturn(json_encode([
                'id' => 'lexoffice-id',
            ]));

        $this->httpClientMock
            ->method('request')
            ->willReturn($responseMock);

        $contact = new Contact();
        $contact
            ->addAddress(
                AddressType::BILLING,
                (new Address())
                    ->setCity('Nürnberg')
                    ->setCountryCode('DE'),
            )
            ->setCompany(
                (new Company())
                    ->addContactPerson(
                        (new Person())
                            ->setFirstName('Max')
                            ->setLastName('Mustermann'),
                    )
                    ->setName('Test company AG')
                    ->setTaxNumber('123/123/1234'),
            );

        $client = $this->getClient();

        $result = $client->createContact($contact);

        $resultArray = ContactTransformer::getInstance()->transformFromObject($result);

        self::assertMatchesJsonSnapshot($resultArray);
    }

    public function testGetUrl(): void
    {
        $client = $this->getClient();

        $refClass = new \ReflectionClass($client);
        $method   = $refClass->getMethod('getUrl');

        $result = $method->invokeArgs($client, [
            'endpoint' => 'https://endpoint.tld',
            'id'       => 'any-id-string',
        ]);

        self::assertEquals('https://unittest.tld/v1https://endpoint.tld/any-id-string', $result);

        $result = $method->invokeArgs($client, [
            'endpoint' => 'https://endpoint.tld',
            'id'       => 'any-id-string',
            'params'   => [
                'param1' => 'val1',
                'param2' => false,
                'param3' => \strval(true),
            ],
        ]);

        self::assertEquals(
            'https://unittest.tld/v1https://endpoint.tld/any-id-string?param1=val1&param2=0&param3=1',
            $result,
        );
    }

    private function getClient(): LexofficeClient
    {
        return new LexofficeClient(
            'test',
            'https://unittest.tld',
            'v1',
            $this->httpClientMock,
            $this->validatorMock,
            $this->filesystemMock,
        );
    }
}
