<?php

declare(strict_types=1);

namespace VarLabIT\LexofficeBundle\Entity\Enum;

enum TaxType: string
{
    case NET                          = 'net';
    case GROSS                        = 'gross';
    case VAT_FREE                     = 'vatfree'; // Steuerfrei
    case INTRA_COMMUNITY_SUPPLY       = 'intraCommunitySupply'; // Innergemeinschaftliche Lieferung gem. §13b UStG
    case CONSTRUCTION_SERVICE_13B     = 'constructionService13b'; // Bauleistungen gem. §13b UStG
    case EXTERNAL_SERVICE_13B         = 'externalService13b'; // Fremdleistungen innerhalb der EU gem. §13b UStG
    case THIRD_PARTY_COUNTRY_SERVICE  = 'thirdPartyCountryService'; // Dienstleistungen an Drittländer
    case THIRD_PARTY_COUNTRY_DELIVERY = 'thirdPartyCountryDelivery'; // Ausfuhrlieferungen an Drittländer
    case PHOTOVOLTAIC_EQUIPMENT       = 'photovoltaicEquipment';
}
