<?php

declare(strict_types=1);

namespace App\Relating\View;

final readonly class ActivityTimelineView extends AbstractArrayView
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
