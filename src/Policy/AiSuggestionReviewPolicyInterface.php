<?php

declare(strict_types=1);

namespace App\Policy;

use App\Application\Command\ReviewAiSuggestionCommand;

interface AiSuggestionReviewPolicyInterface
{
    public function decideAiSuggestionReview(ReviewAiSuggestionCommand $command): PolicyDecisionResult;
}
