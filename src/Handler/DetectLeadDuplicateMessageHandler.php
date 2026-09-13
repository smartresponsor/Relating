<?php

declare(strict_types=1);

namespace App\Handler;

use App\Message\DetectLeadDuplicateMessage;
use App\Service\DuplicateDetectorInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class DetectLeadDuplicateMessageHandler
{
    public function __construct(private DuplicateDetectorInterface $duplicates)
    {
    }

    public function __invoke(DetectLeadDuplicateMessage $message): void
    {
        $this->duplicates->detectCandidatesForTarget(
            BusinessMessagePayload::string($message->payload, 'targetType', 'lead'),
            $message->targetReference,
            BusinessMessagePayload::array($message->payload, 'signals'),
        );
    }
}
