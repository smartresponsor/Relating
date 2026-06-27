<?php

declare(strict_types=1);

namespace App\View;

final readonly class OpportunityDetailView extends AbstractArrayView
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
