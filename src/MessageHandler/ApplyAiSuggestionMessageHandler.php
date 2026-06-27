<?php

declare(strict_types=1);

namespace App\MessageHandler;

use App\Application\Command\ReviewAiSuggestionCommand;
use App\Application\Service\ReviewAiSuggestionApplicationService;
use App\Message\ApplyAiSuggestionMessage;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class ApplyAiSuggestionMessageHandler
{
    public function __construct(private ReviewAiSuggestionApplicationService $service)
    {
    }

    public function __invoke(ApplyAiSuggestionMessage $message): void
    {
        $this->service->reviewAiSuggestion(new ReviewAiSuggestionCommand(
            $message->targetReference,
            BusinessMessagePayload::string($message->payload, 'reviewerReference'),
            'applied',
            BusinessMessagePayload::nullableString($message->payload, 'reason'),
            BusinessMessagePayload::array($message->payload, 'context'),
        ));
    }
}
