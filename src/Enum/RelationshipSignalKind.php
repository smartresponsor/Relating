<?php

declare(strict_types=1);

namespace App\Enum;

enum RelationshipSignalKind: string
{
    case Message = 'message';
    case Order = 'order';
    case Payment = 'payment';
    case Shipment = 'shipment';
    case ProductInterest = 'product_interest';
    case CampaignResponse = 'campaign_response';
    case Case = 'case';
    case Manual = 'manual';
    case Ai = 'ai';
}
