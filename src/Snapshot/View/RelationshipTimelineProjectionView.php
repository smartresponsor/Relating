<?php

declare(strict_types=1);

namespace App\Relating\Snapshot\View;

final readonly class RelationshipTimelineProjectionView extends RelationAbstractArrayView
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
