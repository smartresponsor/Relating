<?php

declare(strict_types=1);

namespace App\View;

final readonly class RelationshipHealthView extends AbstractArrayView
{
    public static function expectedKeys(): array
    {
        return ['relationshipId', 'healthScore', 'fitScore', 'engagementScore', 'risk'];
    }
}
