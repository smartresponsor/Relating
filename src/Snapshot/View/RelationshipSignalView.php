<?php

declare(strict_types=1);

namespace App\Relating\Snapshot\View;

final readonly class RelationshipSignalView extends RelationAbstractArrayView
{
    public static function expectedKeys(): array
    {
        return ['relationshipId', 'signalType', 'sourceComponent', 'sourceReference', 'occurredAt'];
    }
}
