<?php

declare(strict_types=1);

namespace App\Relating\Snapshot\View;

final readonly class RelationshipHealthView extends RelationAbstractArrayView
{
    public static function expectedKeys(): array
    {
        return ['relationshipId', 'healthScore', 'fitScore', 'engagementScore', 'risk'];
    }
}
