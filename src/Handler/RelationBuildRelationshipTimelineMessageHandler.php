<?php

declare(strict_types=1);

namespace App\Relating\Handler;

use App\Relating\Message\RelationBuildRelationshipTimelineMessage;
use App\Relating\Service\RelationActivityTimelineBuilderInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;

#[AsMessageHandler]
final readonly class RelationBuildRelationshipTimelineMessageHandler
{
    public function __construct(private RelationActivityTimelineBuilderInterface $timeline)
    {
    }

    public function __invoke(RelationBuildRelationshipTimelineMessage $message): void
    {
        $this->timeline->buildTimelineForTarget('relationship', $message->targetReference);
    }
}
