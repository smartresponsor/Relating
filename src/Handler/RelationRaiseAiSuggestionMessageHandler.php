<?php

declare(strict_types=1);

namespace App\Relating\Handler;

use App\Relating\Message\RelationRaiseAiSuggestionMessage;
use App\Relating\Service\RelationRelatingAiSuggestionServiceInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class RelationRaiseAiSuggestionMessageHandler
{
    public function __construct(private RelationRelatingAiSuggestionServiceInterface $suggestions)
    {
    }

    public function __invoke(RelationRaiseAiSuggestionMessage $message): void
    {
        $this->suggestions->raiseSuggestionForTarget(
            RelationBusinessMessagePayload::string($message->payload, 'targetType', 'relationship'),
            $message->targetReference,
            RelationBusinessMessagePayload::string($message->payload, 'suggestionType', 'next-best-action'),
            RelationBusinessMessagePayload::array($message->payload, 'context'),
        );
    }
}
