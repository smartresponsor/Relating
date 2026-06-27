<?php

declare(strict_types=1);

namespace App\Relating\View;

final readonly class CaseDetailView extends AbstractArrayView
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
