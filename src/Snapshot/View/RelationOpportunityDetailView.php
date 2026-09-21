<?php

declare(strict_types=1);

namespace App\Relating\Snapshot\View;

final readonly class RelationOpportunityDetailView extends RelationAbstractArrayView
{
    protected static function surfaceName(): string
    {
        return 'opportunity.detail';
    }

    public static function expectedKeys(): array
    {
        return ['id', 'relationshipReference', 'pipeline', 'stage', 'forecast', 'productInterests'];
    }
}
