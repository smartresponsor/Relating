<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Entity\RelationAiSuggestionEntity;

interface RelationRelatingAiSuggestionServiceInterface
{
    /**
     * @param array<string, mixed> $context
     */
    public function raiseSuggestionForTarget(string $targetType, string $targetReference, string $suggestionType, array $context = []): RelationAiSuggestionEntity;
}
