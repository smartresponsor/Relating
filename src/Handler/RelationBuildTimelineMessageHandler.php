<?php

declare(strict_types=1);

namespace App\Relating\Handler;

use App\Relating\Message\RelationBuildTimelineMessage;
use App\Relating\Service\RelationActivityTimelineBuilderInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class RelationBuildTimelineMessageHandler
{
    public function __construct(private RelationActivityTimelineBuilderInterface $timeline)
    {
    }

    public function __invoke(RelationBuildTimelineMessage $message): void
    {
        $this->timeline->buildTimelineForTarget(
            RelationBusinessMessagePayload::string($message->payload, 'targetType', 'relationship'),
            $message->targetReference,
        );
    }
}
