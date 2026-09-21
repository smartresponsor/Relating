<?php

declare(strict_types=1);

namespace App\Relating\Snapshot\View;

final readonly class RelationAiSuggestionReviewView extends RelationAbstractArrayView
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
