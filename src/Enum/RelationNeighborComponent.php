<?php

declare(strict_types=1);

namespace App\Relating\Enum;

enum RelationNeighborComponent: string
{
    case Vendoring = 'vendoring';
    case Accessing = 'accessing';
    case Assessing = 'assessing';
    case Managing = 'managing';
    case Producting = 'producting';
    case Production = 'production';
    case Ordering = 'ordering';
    case Payment = 'payment';
    case Shipment = 'shipment';
    case Messaging = 'messaging';
    case Projecting = 'projecting';
    case Documentating = 'documentating';
    case Media = 'media';
    case Viewing = 'viewing';

    /**
     * @return list<string>
     */
    public static function codes(): array
    {
        return array_map(static fn (self $component): string => $component->value, self::cases());
    }
}
