<?php

declare(strict_types=1);

namespace App\Relating\Policy;

use App\Relating\Command\RelationReviewAiSuggestionCommand;

interface RelationAiSuggestionReviewPolicyInterface
{
    public function decideAiSuggestionReview(RelationReviewAiSuggestionCommand $command): RelationPolicyDecisionResult;
}
