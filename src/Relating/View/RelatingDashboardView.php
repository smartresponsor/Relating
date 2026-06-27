<?php

declare(strict_types=1);

namespace App\Relating\View;

final readonly class RelatingDashboardView extends AbstractArrayView
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
