<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Entity\RelationAiSuggestionEntity;

interface RelationAiSuggestionReviewerInterface
{
    public function acceptForApplication(string $suggestionReference, string $reviewerReference): RelationAiSuggestionEntity;

    public function rejectWithReason(string $suggestionReference, string $reviewerReference, string $reason): RelationAiSuggestionEntity;

    public function markApplied(string $suggestionReference, string $reviewerReference): RelationAiSuggestionEntity;
}
