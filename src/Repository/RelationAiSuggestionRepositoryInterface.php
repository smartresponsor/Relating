<?php

declare(strict_types=1);

namespace App\Relating\Repository;

use App\Relating\Entity\RelationAiSuggestion;

interface RelationAiSuggestionRepositoryInterface
{
    public function rememberRaised(RelationAiSuggestion $suggestion): void;

    public function rememberReviewed(RelationAiSuggestion $suggestion): void;

    public function rememberApplied(RelationAiSuggestion $suggestion): void;

    public function suggestionOf(string $suggestionReference): ?RelationAiSuggestion;

    /** @return list<RelationAiSuggestion> */
    public function pendingSuggestionsForTarget(string $targetType, string $targetReference): array;
}
