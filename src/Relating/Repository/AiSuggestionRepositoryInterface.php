<?php

declare(strict_types=1);

namespace App\Relating\Repository;

use App\Relating\Entity\AiSuggestion;

interface AiSuggestionRepositoryInterface
{
    public function rememberRaised(AiSuggestion $suggestion): void;

    public function rememberReviewed(AiSuggestion $suggestion): void;

    public function rememberApplied(AiSuggestion $suggestion): void;

    public function suggestionOf(string $suggestionReference): ?AiSuggestion;

    /** @return list<AiSuggestion> */
    public function pendingSuggestionsForTarget(string $targetType, string $targetReference): array;
}
