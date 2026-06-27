<?php

declare(strict_types=1);

namespace App\MessageHandler;

use App\Message\RaiseAiSuggestionMessage;
use App\Service\RelatingAiSuggestionServiceInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class RaiseAiSuggestionMessageHandler
{
    public function __construct(private RelatingAiSuggestionServiceInterface $suggestions)
    {
    }

    public function __invoke(RaiseAiSuggestionMessage $message): void
    {
        $this->suggestions->raiseSuggestionForTarget(
            BusinessMessagePayload::string($message->payload, 'targetType', 'relationship'),
            $message->targetReference,
            BusinessMessagePayload::string($message->payload, 'suggestionType', 'next-best-action'),
            BusinessMessagePayload::array($message->payload, 'context'),
        );
    }
}
