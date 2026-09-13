<?php

declare(strict_types=1);

namespace App\Snapshot\View;

final readonly class LeadListView extends AbstractArrayView
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
