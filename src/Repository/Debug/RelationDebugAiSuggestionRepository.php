<?php

declare(strict_types=1);

namespace App\Relating\Repository\Debug;

use App\Relating\Entity\RelationAiSuggestion;
use App\Relating\Repository\RelationAiSuggestionRepositoryInterface;

final readonly class RelationDebugAiSuggestionRepository implements RelationAiSuggestionRepositoryInterface
{
    private const BUCKET = 'ai_suggestion';

    public function __construct(
        private RelationDebugRelatingObjectStore $store,
    ) {
    }

    public function rememberRaised(RelationAiSuggestion $suggestion): void
    {
        $this->remember($suggestion);
    }

    public function rememberReviewed(RelationAiSuggestion $suggestion): void
    {
        $this->remember($suggestion);
    }

    public function rememberApplied(RelationAiSuggestion $suggestion): void
    {
        $this->remember($suggestion);
    }

    public function suggestionOf(string $suggestionReference): ?RelationAiSuggestion
    {
        $suggestion = $this->store->one(self::BUCKET, $suggestionReference);

        return $suggestion instanceof RelationAiSuggestion ? $suggestion : null;
    }

    public function pendingSuggestionsForTarget(string $targetType, string $targetReference): array
    {
        return array_values(array_filter(
            $this->store->all(self::BUCKET),
            static fn (mixed $item): bool => $item instanceof RelationAiSuggestion,
        ));
    }

    private function remember(RelationAiSuggestion $suggestion): void
    {
        $this->store->remember(self::BUCKET, $suggestion->id(), $suggestion);
    }
}
