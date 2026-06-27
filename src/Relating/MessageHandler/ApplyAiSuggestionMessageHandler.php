<?php

declare(strict_types=1);

namespace App\Relating\MessageHandler;

use App\Relating\Application\Command\ReviewAiSuggestionCommand;
use App\Relating\Application\Service\ReviewAiSuggestionApplicationService;
use App\Relating\Message\ApplyAiSuggestionMessage;
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
