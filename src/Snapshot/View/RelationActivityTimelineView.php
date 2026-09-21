<?php

declare(strict_types=1);

namespace App\Relating\Snapshot\View;

final readonly class RelationActivityTimelineView extends RelationAbstractArrayView
{
    protected static function surfaceName(): string
    {
        return 'activity.timeline';
    }

    public static function expectedKeys(): array
    {
        return ['target', 'items', 'nextCursor', 'generatedAt'];
    }
}
