<?php

declare(strict_types=1);

namespace App\Relating\Snapshot\View;

final readonly class RelationOpportunityListView extends RelationAbstractArrayView
{
    protected static function surfaceName(): string
    {
        return 'opportunity.list';
    }

    public static function expectedKeys(): array
    {
        return ['items', 'nextCursor', 'filters', 'sort'];
    }
}
