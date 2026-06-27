<?php

declare(strict_types=1);


namespace App\Enum;

enum RelationshipKind: string
{
    case Customer = 'customer';
    case Prospect = 'prospect';
    case Partner = 'partner';
    case Reseller = 'reseller';
    case Supplier = 'supplier';
    case Community = 'community';
}
