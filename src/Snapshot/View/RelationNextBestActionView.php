<?php

declare(strict_types=1);

namespace App\Relating\Snapshot\View;

final readonly class RelationNextBestActionView extends RelationAbstractArrayView
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
