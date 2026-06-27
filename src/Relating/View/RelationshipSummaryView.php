<?php

declare(strict_types=1);

namespace App\Relating\View;

final readonly class RelationshipSummaryView extends AbstractArrayView
{
    protected static function surfaceName(): string
    {
        return 'relationship.summary';
    }

    public static function expectedKeys(): array
    {
        return ['id', 'vendorReference', 'status', 'lifecycleStage', 'healthScore', 'engagementScore', 'nextActionAt'];
    }
}
