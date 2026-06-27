<?php

declare(strict_types=1);

namespace App\Application\Service;

use App\Application\Command\ReviewAiSuggestionCommand;
use App\Application\Result\RelatingActionResult;
use App\Enum\AiSuggestionDecision;
use App\Event\AiSuggestionAccepted;
use App\Event\AiSuggestionRejected;
use App\Event\AiSuggestionReviewed;
use App\Exception\RelatingApplicationException;
use App\Repository\AiSuggestionRepositoryInterface;
use App\Service\RelatingBusinessEventRecorderInterface;

final readonly class ReviewAiSuggestionApplicationService
{
    public function __construct(
        private AiSuggestionRepositoryInterface $suggestions,
        private RelatingBusinessEventRecorderInterface $events,
    ) {
    }

    public function reviewAiSuggestion(ReviewAiSuggestionCommand $command): RelatingActionResult
    {
        $suggestion = $this->suggestions->suggestionOf($command->suggestionReference);

        if ($suggestion === null) {
            throw RelatingApplicationException::missingReference('AI suggestion', $command->suggestionReference);
        }

        $decision = AiSuggestionDecision::tryFrom($command->decision) ?? AiSuggestionDecision::Rejected;
        $this->suggestions->rememberReviewed($suggestion);
        $this->events->recordBusinessEvent(new AiSuggestionReviewed($suggestion->id(), [
            'reviewer_reference' => $command->reviewerReference,
            'decision' => $decision->value,
            'reason' => $command->reason,
            'context' => $command->context,
        ]));

        if ($decision === AiSuggestionDecision::Accepted) {
            $this->events->recordBusinessEvent(new AiSuggestionAccepted($suggestion->id(), [
                'reviewer_reference' => $command->reviewerReference,
            ]));
        }

        if ($decision === AiSuggestionDecision::Rejected) {
            $this->events->recordBusinessEvent(new AiSuggestionRejected($suggestion->id(), [
                'reviewer_reference' => $command->reviewerReference,
                'reason' => $command->reason,
            ]));
        }

        return new RelatingActionResult('ai-review', $suggestion->id(), [
            'decision' => $decision->value,
            'reviewer_reference' => $command->reviewerReference,
        ]);
    }
}
