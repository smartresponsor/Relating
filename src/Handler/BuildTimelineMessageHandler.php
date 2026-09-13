<?php

declare(strict_types=1);

namespace App\Handler;

use App\Message\BuildTimelineMessage;
use App\Service\ActivityTimelineBuilderInterface;
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
