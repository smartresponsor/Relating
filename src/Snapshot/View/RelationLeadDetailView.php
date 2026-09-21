<?php

declare(strict_types=1);

namespace App\Relating\Snapshot\View;

final readonly class RelationLeadDetailView extends RelationAbstractArrayView
{
    protected static function surfaceName(): string
    {
        return 'lead.detail';
    }

    public static function expectedKeys(): array
    {
        return ['id', 'status', 'source', 'qualification', 'relationshipReference', 'conversion'];
    }
}
