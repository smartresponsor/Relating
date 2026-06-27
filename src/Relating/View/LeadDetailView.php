<?php

declare(strict_types=1);

namespace App\Relating\View;

final readonly class LeadDetailView extends AbstractArrayView
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
