# lexoffice-Bundle for Symfony

## Introduction

This bundle integrates the [lexoffice public API](https://developers.lexoffice.io/docs) into Symfony, utilizing
Symfony's serializer to convert API responses into objects. Compatible with Symfony 6.4.

## Installation

1. **Download the Bundle**

Add the bundle to your `composer.json`:

```bash
composer require var-lab/lexoffice-bundle
```

### 2. Register the Bundle

(should be done automatically by composer)

```php

    return [
        // ...
        VarLabIT\LexofficeBundle\VarLabITLexofficeBundle::class => ['all' => true],
    ];
```

### 3. Add configuration

Create the config file `config/packages/var_lab_it_lexoffice.yaml` with following content:

```yaml
var_lab_it_lexoffice:
  api_key: '%env(LEXOFFICE_API_KEY)%'
```

add the api key to your `.env`:

```dotenv
# ...
LEXOFFICE_API_KEY=<your-api-key>
```

## Usage

The following API functions are currently covered:

- Contacts
    - [x] fetch contact
    - [x] create contact
    - [x] update contact
- Invoices
    - [x] create invoice
    - [x] update invoice
    - [x] fetch invoice
    - [x] download invoice pdf

The lexoffice bundle is currently undergoing further development.
Your own pull requests are welcome.

### Contacts

Create a new contact:

```php
<?php

use VarLabIT\LexofficeBundle\Entity\Address;
use VarLabIT\LexofficeBundle\Entity\Company as LexofficeCompany;
use VarLabIT\LexofficeBundle\Entity\Contact;
use VarLabIT\LexofficeBundle\Entity\ContactRole;
use VarLabIT\LexofficeBundle\Entity\Enum\AddressType;
use VarLabIT\LexofficeBundle\Entity\Enum\RoleType;
use VarLabIT\LexofficeBundle\Entity\Person;
use VarLabIT\LexofficeBundle\LexofficeClient;

class CityPageController extends AbstractController {
    
    public function __construct(
        private readonly CompanyRepository        $companyRepository,
        private readonly LexofficeClient          $lexofficeClient,
    )
    {
    }

    private function getContactObject(Company $company): Contact
    {
        $contact = new Contact();
        $contact
            ->setVersion(0)
            ->addRole(RoleType::CUSTOMER, new ContactRole())
            ->setCompany(
                (new LexofficeCompany())
                    ->setName($company->getName())
                    ->addContactPerson(
                        (new Person())
                            ->setFirstName($company->getGivenName())
                            ->setLastName($company->getFamilyName())
                            ->setEmailAddress($company->getInvoiceEmail())
                            ->setPrimary(true)
                            ->setPhoneNumber($company->getContactPhone())
                    ),
            )
            ->addAddress(
                AddressType::BILLING,
                (new Address())
                    ->setSupplement('Rechnungsadresse')
                    ->setStreet($company->getAddress())
                    ->setZip($company->getZipcode())
                    ->setCity($company->getCity())
                    ->setCountryCode($company->getCountry())
            );
            
        return $contact;
    }

    public function createContact(int $companyId): Response {
        $company = $this->companyRepository->find($companyId);
        $contact = $this->createContact($company);
        
        $contact = $this->lexofficeClient->createContact($contact);
        
        $company
            ->setVersion($contact->getVersion())
            ->setLexofficeId($contact->getId());
    }
}
```

Update a contact:

```php

    public function createContact(int $companyId): Response {
        $company = $this->companyRepository->find($companyId);
        $contact = $this->createContact($company);
        
        $contact = $this->lexofficeClient->updateContact($contact);
        
        $company
            ->setVersion($contact->getVersion())
            ->setLexofficeId($contact->getId());
    }
```

# Maintainer

This bundle is maintained and created by [var-lab IT GmbH](https://var-lab.com) and contributors.
