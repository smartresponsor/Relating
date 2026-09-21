<?php

declare(strict_types=1);

namespace App\Relating\Handler;

use App\Relating\Message\RelationDetectLeadDuplicateMessage;
use App\Relating\Service\RelationDuplicateDetectorInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class RelationDetectLeadDuplicateMessageHandler
{
    public function __construct(private RelationDuplicateDetectorInterface $duplicates)
    {
    }

    public function __invoke(RelationDetectLeadDuplicateMessage $message): void
    {
        $this->duplicates->detectCandidatesForTarget(
            RelationBusinessMessagePayload::string($message->payload, 'targetType', 'lead'),
            $message->targetReference,
            RelationBusinessMessagePayload::array($message->payload, 'signals'),
        );
    }
}
