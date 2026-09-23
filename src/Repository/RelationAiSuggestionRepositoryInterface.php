<?php

declare(strict_types=1);

namespace App\Relating\Repository;

use App\Relating\Entity\RelationAiSuggestionEntity;

interface RelationAiSuggestionRepositoryInterface
{
    public function rememberRaised(RelationAiSuggestionEntity $suggestion): void;

    public function rememberReviewed(RelationAiSuggestionEntity $suggestion): void;

    public function rememberApplied(RelationAiSuggestionEntity $suggestion): void;

    public function suggestionOf(string $suggestionReference): ?RelationAiSuggestionEntity;

    /** @return list<RelationAiSuggestionEntity> */
    public function pendingSuggestionsForTarget(string $targetType, string $targetReference): array;
}
