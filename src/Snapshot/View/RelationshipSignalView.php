<?php

declare(strict_types=1);

namespace App\Snapshot\View;

final readonly class RelationshipSignalView extends AbstractArrayView
{
    public static function expectedKeys(): array
    {
        return ['relationshipId', 'signalType', 'sourceComponent', 'sourceReference', 'occurredAt'];
    }
}
