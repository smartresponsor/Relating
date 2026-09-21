<?php

declare(strict_types=1);

namespace App\Relating\Snapshot\View;

final readonly class RelationCaseQueueView extends RelationAbstractArrayView
{
    protected static function surfaceName(): string
    {
        return 'case.queue';
    }

    public static function expectedKeys(): array
    {
        return ['items', 'slaSummary', 'nextCursor', 'generatedAt'];
    }
}
