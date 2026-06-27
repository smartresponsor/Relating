<?php

declare(strict_types=1);

namespace App\Enum;

enum NeighborReferenceKind: string
{
    case Vendor = 'vendor';
    case AccessSubject = 'access_subject';
    case Owner = 'owner';
    case Operator = 'operator';
    case Product = 'product';
    case Order = 'order';
    case Payment = 'payment';
    case Shipment = 'shipment';
    case MessageThread = 'message_thread';
    case Project = 'project';
    case Document = 'document';
    case DocumentTemplate = 'document_template';
    case Membership = 'membership';
    case Contribution = 'contribution';
    case Event = 'event';
    case ViewSurface = 'view_surface';

    /**
     * @return list<string>
     */
    public static function codes(): array
    {
        return array_map(static fn (self $kind): string => $kind->value, self::cases());
    }
}
