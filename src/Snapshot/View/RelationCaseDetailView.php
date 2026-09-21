<?php

declare(strict_types=1);

namespace App\Relating\Snapshot\View;

final readonly class RelationCaseDetailView extends RelationAbstractArrayView
{
    protected static function surfaceName(): string
    {
        return 'case.detail';
    }

    public static function expectedKeys(): array
    {
        return ['id', 'relationshipReference', 'status', 'priority', 'sla', 'timeline'];
    }
}
