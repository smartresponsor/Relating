<?php

declare(strict_types=1);

namespace App\Snapshot\View;

final readonly class RelationshipTimelineProjectionView extends AbstractArrayView
{
    protected static function surfaceName(): string
    {
        return 'relationship.timeline.projection';
    }

    /**
     * @return list<string>
     */
    public static function expectedKeys(): array
    {
        return ['relationshipTimeline'];
    }
}
