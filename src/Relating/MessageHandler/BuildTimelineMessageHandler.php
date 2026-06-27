<?php

declare(strict_types=1);

namespace App\Relating\MessageHandler;

use App\Relating\Message\BuildTimelineMessage;
use App\Relating\Service\ActivityTimelineBuilderInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class BuildTimelineMessageHandler
{
    public function __construct(private ActivityTimelineBuilderInterface $timeline)
    {
    }

    public function __invoke(BuildTimelineMessage $message): void
    {
        $this->timeline->buildTimelineForTarget(
            BusinessMessagePayload::string($message->payload, 'targetType', 'relationship'),
            $message->targetReference,
        );
    }
}
