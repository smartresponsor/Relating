<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\AiSuggestion;

interface RelatingAiSuggestionServiceInterface
{
    /**
     * @param array<string, mixed> $context
     */
    public function raiseSuggestionForTarget(string $targetType, string $targetReference, string $suggestionType, array $context = []): AiSuggestion;
}
