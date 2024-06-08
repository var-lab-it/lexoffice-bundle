<?php

declare(strict_types=1);

namespace VarLabIT\LexofficeBundle;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\ResponseInterface;
use VarLabIT\LexofficeBundle\Entity\Contact;
use VarLabIT\LexofficeBundle\Entity\Invoice;
use VarLabIT\LexofficeBundle\Exception\ValidationException;
use VarLabIT\LexofficeBundle\Transformer\ContactTransformer;
use VarLabIT\LexofficeBundle\Transformer\InvoiceTransformer;
use function Safe\base64_decode;
use function Safe\json_decode;

class LexofficeClient
{
    private const ENDPOINT_CONTACTS = '/contacts';
    private const ENDPOINT_INVOICES = '/invoices';
    private const ENDPOINT_FILES    = '/files';

    public function __construct(
        private readonly string $apiKey,
        private readonly string $apiEndpoint,
        private readonly string $apiVersion,
        private readonly HttpClientInterface $client,
        private readonly ValidatorInterface $validator,
        private readonly Filesystem $filesystem,
    ) {
    }

    public function createInvoice(Invoice $invoice, bool $finalize = false): Invoice
    {
        $errors = $this->validator->validate($invoice);

        if (\count($errors) > 0) {
            throw new ValidationException($errors);
        }

        $data = InvoiceTransformer::getInstance()->transformFromObject($invoice);

        $response = $this->sendRequest('POST', $this->getUrl(
            self::ENDPOINT_INVOICES,
            '',
            [
                'finalize' => \strval($finalize),
            ],
        ), $data);

        $id = $this->getLexofficeId($response);

        $invoice->setId($id);

        return $invoice;
    }

    public function fetchInvoice(string $invoiceId): ?Invoice
    {
        $response = $this->sendRequest('GET', $this->getUrl(self::ENDPOINT_INVOICES, $invoiceId));

        return InvoiceTransformer::getInstance()->transformToObject($response->getContent());
    }

    public function downloadInvoicePdf(string $documentId, string $targetFilePath): string
    {
        $response = $this->sendRequest('GET', $this->getUrl(self::ENDPOINT_FILES, $documentId));
        $content  = $response->getContent();

        $this->filesystem->dumpFile(
            $targetFilePath,
            base64_decode($content),
        );

        return $targetFilePath;
    }

    public function fetchContact(string $contactId): ?Contact
    {
        $response = $this->sendRequest('GET', $this->getUrl(self::ENDPOINT_CONTACTS, $contactId));

        return ContactTransformer::getInstance()->transformToObject($response->getContent());
    }

    public function createContact(Contact $contact): Contact
    {
        $errors = $this->validator->validate($contact);

        if (\count($errors) > 0) {
            throw new ValidationException($errors);
        }

        $data = ContactTransformer::getInstance()->transformFromObject($contact);

        $response = $this->sendRequest('POST', $this->getUrl(self::ENDPOINT_CONTACTS), $data);

        $id = $this->getLexofficeId($response);

        $contact->setId($id);

        return $contact;
    }

    public function updateContact(Contact $contact): Contact
    {
        $errors = $this->validator->validate($contact);

        if (\count($errors) > 0) {
            throw new ValidationException($errors);
        }

        $data = ContactTransformer::getInstance()->transformFromObject($contact);

        $response = $this->sendRequest('PUT', $this->getUrl(self::ENDPOINT_CONTACTS, $contact->getId()), $data);

        $id = $this->getLexofficeId($response);

        $contact->setId($id);

        return $contact;
    }

    /** @param array<string, string> $params */
    private function getUrl(string $endpoint, string $id = '', array $params = []): string
    {
        $url = $this->apiEndpoint . '/' . $this->apiVersion . $endpoint;

        if ('' !== $id) {
            $url .= '/' . $id;
        }

        if (\count($params) > 0) {
            $url .= '?' . \http_build_query($params);
        }

        return $url;
    }

    /** @return array<string, string> */
    private function getRequestHeaders(): array
    {
        /** @var array<string, string> $requestHeader */
        $requestHeader = [
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type'  => 'application/json',
            'Accept'        => 'application/json',
        ];

        return $requestHeader;
    }

    /**
     * @param array<mixed> $data
     *
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function sendRequest(
        string $method,
        string $url,
        array $data = [],
    ): ResponseInterface {
        $options = ['headers' => $this->getRequestHeaders()];

        $options['json'] = $data;

        $response = $this->client->request($method, $url, $options);
        \sleep(2);

        $httpResponseCode = $response->getStatusCode();

        if (Response::HTTP_NOT_FOUND === $httpResponseCode) {
            throw new NotFoundHttpException('Item not found in lexoffice.');
        }

        return $response;
    }

    private function getLexofficeId(ResponseInterface $response): string
    {
        $responseContent = $response->getContent();

        /** @var array{
         *    id: string,
         * } $data
         */
        $data = json_decode($responseContent, true);

        return $data['id'];
    }
}
