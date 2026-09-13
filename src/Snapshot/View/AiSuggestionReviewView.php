<?php

declare(strict_types=1);

namespace App\Snapshot\View;

final readonly class AiSuggestionReviewView extends AbstractArrayView
{
    protected static function surfaceName(): string
    {
        return 'ai.suggestion_review';
    }

    public static function expectedKeys(): array
    {
        return ['suggestionId', 'target', 'decision', 'reason', 'payload'];
    }
}
