<?php

declare(strict_types=1);

namespace App\Relating\View;

final readonly class NextBestActionView extends AbstractArrayView
{
    protected static function surfaceName(): string
    {
        return 'ai.next_best_action';
    }

    public static function expectedKeys(): array
    {
        return ['target', 'actions', 'generatedAt'];
    }
}
