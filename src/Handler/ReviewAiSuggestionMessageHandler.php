<?php

declare(strict_types=1);

namespace App\Handler;

use App\Command\ReviewAiSuggestionCommand;
use App\Message\ReviewAiSuggestionMessage;
use App\Service\Application\ReviewAiSuggestionApplicationService;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class ReviewAiSuggestionMessageHandler
{
    public function __construct(private ReviewAiSuggestionApplicationService $service)
    {
    }

    public function __invoke(ReviewAiSuggestionMessage $message): void
    {
        $this->service->reviewAiSuggestion(new ReviewAiSuggestionCommand(
            $message->targetReference,
            BusinessMessagePayload::string($message->payload, 'reviewerReference'),
            BusinessMessagePayload::string($message->payload, 'decision', 'accepted'),
            BusinessMessagePayload::nullableString($message->payload, 'reason'),
            BusinessMessagePayload::array($message->payload, 'context'),
        ));
    }
}
