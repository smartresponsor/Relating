<?php

declare(strict_types=1);

namespace App\View;

final readonly class OpportunityListView extends AbstractArrayView
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
