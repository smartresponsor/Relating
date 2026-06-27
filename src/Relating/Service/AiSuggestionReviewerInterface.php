<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Entity\AiSuggestion;

interface AiSuggestionReviewerInterface
{
    public function acceptForApplication(string $suggestionReference, string $reviewerReference): AiSuggestion;

    public function rejectWithReason(string $suggestionReference, string $reviewerReference, string $reason): AiSuggestion;

    public function markApplied(string $suggestionReference, string $reviewerReference): AiSuggestion;
}
