<?php

declare(strict_types=1);

namespace App\Relating\Policy;

use App\Relating\Application\Command\ReviewAiSuggestionCommand;

interface AiSuggestionReviewPolicyInterface
{
    public function decideAiSuggestionReview(ReviewAiSuggestionCommand $command): PolicyDecisionResult;
}
