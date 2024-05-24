<?php

declare(strict_types=1);

namespace VarLabIT\LexofficeBundle\Entity\Enum;

enum ShippingType: string
{
    case SERVICE         = 'service'; // a service is supplied on shippingDate
    case SERVICE_PERIOD  = 'serviceperiod'; // a service is supplied within the period [shippingDate, shippingEndDate]
    case DELIVERY        = 'delivery'; // a product is delivered
    case DELIVERY_PERIOD = 'deliveryperiod'; // a product is delivered within the period [shippingDate, shippingEndDate]
    case NONE            = 'none'; // no shipping date has to be provided
}
