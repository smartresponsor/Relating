<?php

declare(strict_types=1);

namespace App\Relating\View;

final readonly class RelationshipTimelineView extends AbstractArrayView
{
    protected static function surfaceName(): string
    {
        return 'relationship.timeline';
    }

    public static function expectedKeys(): array
    {
        return ['relationshipId', 'events', 'nextCursor', 'generatedAt'];
    }
}
