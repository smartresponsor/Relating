<?php

declare(strict_types=1);

namespace App\MessageHandler;

use App\Message\BuildRelationshipTimelineMessage;
use App\Service\ActivityTimelineBuilderInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class BuildRelationshipTimelineMessageHandler
{
    public function __construct(private ActivityTimelineBuilderInterface $timeline)
    {
    }

    public function __invoke(BuildRelationshipTimelineMessage $message): void
    {
        $this->timeline->buildTimelineForTarget('relationship', $message->targetReference);
    }
}
