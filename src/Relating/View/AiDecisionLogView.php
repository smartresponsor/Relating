<?php

declare(strict_types=1);

namespace App\Relating\View;

final readonly class AiDecisionLogView extends AbstractArrayView
{
    public static function expectedKeys(): array
    {
        return ['suggestionId', 'status', 'reviewedBy', 'reviewedAt'];
    }
}
