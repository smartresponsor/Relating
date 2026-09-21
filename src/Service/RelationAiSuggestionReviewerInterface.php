<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Entity\RelationAiSuggestion;

interface RelationAiSuggestionReviewerInterface
{
    public function acceptForApplication(string $suggestionReference, string $reviewerReference): RelationAiSuggestion;

    public function rejectWithReason(string $suggestionReference, string $reviewerReference, string $reason): RelationAiSuggestion;

    public function markApplied(string $suggestionReference, string $reviewerReference): RelationAiSuggestion;
}
