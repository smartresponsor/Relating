<?php

declare(strict_types=1);

namespace App\Relating\Application\Service;

use App\Relating\Application\Command\ProjectTimelineCommand;
use App\Relating\Application\Result\RelatingActionResult;
use App\Relating\Entity\TimelineEvent;
use App\Relating\Enum\TimelineEventKind;
use App\Relating\Event\TimelineEventProjected;
use App\Relating\Repository\TimelineEventRepositoryInterface;
use App\Relating\Service\RelatingBusinessEventRecorderInterface;
use App\Relating\Service\RelatingIdGeneratorInterface;

final readonly class ProjectTimelineApplicationService
{
    public function __construct(
        private TimelineEventRepositoryInterface $timelineEvents,
        private RelatingIdGeneratorInterface $ids,
        private RelatingBusinessEventRecorderInterface $events,
    ) {
    }

    public function projectTimeline(ProjectTimelineCommand $command): RelatingActionResult
    {
        $kind = TimelineEventKind::tryFrom($command->eventKind) ?? TimelineEventKind::NeighborSignalCaptured;
        $event = new TimelineEvent(
            $this->ids->nextTimelineEventId(),
            $command->targetType,
            $command->targetReference,
            $kind,
            $command->payload,
            $command->occurredAt
        );
        $event->attachRelationship($command->relationshipReference);
        $event->attachSource($command->sourceComponent, $command->sourceReference);

        $this->timelineEvents->rememberProjected($event);
        $this->events->recordBusinessEvent(new TimelineEventProjected($event->id(), [
            'target_type' => $command->targetType,
            'target_reference' => $command->targetReference,
            'event_kind' => $kind->value,
            'relationship_reference' => $command->relationshipReference,
        ]));

        return new RelatingActionResult('timeline-project', $event->id(), [
            'target_type' => $command->targetType,
            'target_reference' => $command->targetReference,
            'event_kind' => $kind->value,
            'occurred_at' => $event->occurredAt()->format(DATE_ATOM),
        ]);
    }
}
