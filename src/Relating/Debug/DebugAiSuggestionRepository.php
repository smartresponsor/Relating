<?php

declare(strict_types=1);

namespace App\Relating\Debug;

use App\Relating\Entity\AiSuggestion;
use App\Relating\Repository\AiSuggestionRepositoryInterface;

final readonly class DebugAiSuggestionRepository implements AiSuggestionRepositoryInterface
{
    private const BUCKET = 'ai_suggestion';

    public function __construct(
        private DebugRelatingObjectStore $store,
    ) {
    }

    public function rememberRaised(AiSuggestion $suggestion): void
    {
        $this->remember($suggestion);
    }

    public function rememberReviewed(AiSuggestion $suggestion): void
    {
        $this->remember($suggestion);
    }

    public function rememberApplied(AiSuggestion $suggestion): void
    {
        $this->remember($suggestion);
    }

    public function suggestionOf(string $suggestionReference): ?AiSuggestion
    {
        $suggestion = $this->store->one(self::BUCKET, $suggestionReference);

        return $suggestion instanceof AiSuggestion ? $suggestion : null;
    }

    public function pendingSuggestionsForTarget(string $targetType, string $targetReference): array
    {
        return array_values(array_filter(
            $this->store->all(self::BUCKET),
            static fn (mixed $item): bool => $item instanceof AiSuggestion,
        ));
    }

    private function remember(AiSuggestion $suggestion): void
    {
        $this->store->remember(self::BUCKET, $suggestion->id(), $suggestion);
    }
}
