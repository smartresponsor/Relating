<?php

declare(strict_types=1);

namespace App\Relating\Service\Application;

use App\Relating\Command\RelationReviewAiSuggestionCommand;
use App\Relating\Enum\RelationAiSuggestionDecision;
use App\Relating\Event\RelationAiSuggestionAccepted;
use App\Relating\Event\RelationAiSuggestionRejected;
use App\Relating\Event\RelationAiSuggestionReviewed;
use App\Relating\Exception\RelationRelatingApplicationException;
use App\Relating\Repository\RelationAiSuggestionRepositoryInterface;
use App\Relating\Service\RelationRelatingBusinessEventRecorderInterface;
use App\Relating\ValueObject\RelationRelatingActionResult;

final readonly class RelationReviewAiSuggestionApplicationService
{
    public function __construct(
        private RelationAiSuggestionRepositoryInterface $suggestions,
        private RelationRelatingBusinessEventRecorderInterface $events,
    ) {
    }

    public function reviewAiSuggestion(RelationReviewAiSuggestionCommand $command): RelationRelatingActionResult
    {
        $suggestion = $this->suggestions->suggestionOf($command->suggestionReference);

        if (null === $suggestion) {
            throw RelationRelatingApplicationException::missingReference('AI suggestion', $command->suggestionReference);
        }

        $decision = RelationAiSuggestionDecision::tryFrom($command->decision) ?? RelationAiSuggestionDecision::Rejected;
        $this->suggestions->rememberReviewed($suggestion);
        $this->events->recordBusinessEvent(new RelationAiSuggestionReviewed($suggestion->id(), [
            'reviewer_reference' => $command->reviewerReference,
            'decision' => $decision->value,
            'reason' => $command->reason,
            'context' => $command->context,
        ]));

        if (RelationAiSuggestionDecision::Accepted === $decision) {
            $this->events->recordBusinessEvent(new RelationAiSuggestionAccepted($suggestion->id(), [
                'reviewer_reference' => $command->reviewerReference,
            ]));
        }

        if (RelationAiSuggestionDecision::Rejected === $decision) {
            $this->events->recordBusinessEvent(new RelationAiSuggestionRejected($suggestion->id(), [
                'reviewer_reference' => $command->reviewerReference,
                'reason' => $command->reason,
            ]));
        }

        return new RelationRelatingActionResult('ai-review', $suggestion->id(), [
            'decision' => $decision->value,
            'reviewer_reference' => $command->reviewerReference,
        ]);
    }
}
