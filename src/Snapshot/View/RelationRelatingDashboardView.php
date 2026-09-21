<?php

declare(strict_types=1);

namespace App\Relating\Snapshot\View;

final readonly class RelationRelatingDashboardView extends RelationAbstractArrayView
{
    protected static function surfaceName(): string
    {
        return 'dashboard';
    }

    public static function expectedKeys(): array
    {
        return ['relationships', 'leads', 'opportunities', 'activities', 'generatedAt'];
    }
}
