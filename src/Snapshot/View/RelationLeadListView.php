<?php

declare(strict_types=1);

namespace App\Relating\Snapshot\View;

final readonly class RelationLeadListView extends RelationAbstractArrayView
{
    protected static function surfaceName(): string
    {
        return 'lead.list';
    }

    public static function expectedKeys(): array
    {
        return ['items', 'nextCursor', 'filters', 'sort'];
    }
}
