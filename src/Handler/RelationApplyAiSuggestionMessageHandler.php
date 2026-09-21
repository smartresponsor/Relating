<?php

declare(strict_types=1);

namespace App\Relating\Handler;

use App\Relating\Command\RelationReviewAiSuggestionCommand;
use App\Relating\Message\RelationApplyAiSuggestionMessage;
use App\Relating\Service\Application\RelationReviewAiSuggestionApplicationService;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class RelationApplyAiSuggestionMessageHandler
{
    public function __construct(private RelationReviewAiSuggestionApplicationService $service)
    {
    }

    public function __invoke(RelationApplyAiSuggestionMessage $message): void
    {
        $this->service->reviewAiSuggestion(new RelationReviewAiSuggestionCommand(
            $message->targetReference,
            RelationBusinessMessagePayload::string($message->payload, 'reviewerReference'),
            'applied',
            RelationBusinessMessagePayload::nullableString($message->payload, 'reason'),
            RelationBusinessMessagePayload::array($message->payload, 'context'),
        ));
    }
}
