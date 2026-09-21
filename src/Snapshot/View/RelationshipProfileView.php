<?php

declare(strict_types=1);

namespace App\Relating\Snapshot\View;

final readonly class RelationshipProfileView extends RelationAbstractArrayView
{
    protected static function surfaceName(): string
    {
        return 'relationship.profile';
    }

    public static function expectedKeys(): array
    {
        return ['id', 'vendorReference', 'status', 'lifecycleStage', 'healthScore', 'engagementScore', 'lastActivityAt', 'nextActionAt'];
    }
}
