<?php

declare(strict_types=1);

namespace App\View;

final readonly class CaseQueueView extends AbstractArrayView
{
    protected static function surfaceName(): string
    {
        return 'case.queue';
    }

    public static function expectedKeys(): array
    {
        return ['items', 'slaSummary', 'nextCursor', 'generatedAt'];
    }
}
