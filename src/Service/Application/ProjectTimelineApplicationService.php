<?php

declare(strict_types=1);

namespace App\Service\Application;

use App\Command\ProjectTimelineCommand;
use App\Entity\TimelineRecord;
use App\Enum\TimelineRecordKind;
use App\Event\TimelineRecordProjected;
use App\Repository\TimelineRecordRepositoryInterface;
use App\Service\RelatingBusinessEventRecorderInterface;
use App\Service\RelatingIdGeneratorInterface;
use App\ValueObject\RelatingActionResult;

final readonly class ProjectTimelineApplicationService
{
    public function __construct(
        private TimelineRecordRepositoryInterface $timelineEvents,
        private RelatingIdGeneratorInterface $ids,
        private RelatingBusinessEventRecorderInterface $events,
    ) {
    }

    public function projectTimeline(ProjectTimelineCommand $command): RelatingActionResult
    {
        $kind = TimelineRecordKind::tryFrom($command->eventKind) ?? TimelineRecordKind::NeighborSignalCaptured;
        $event = new TimelineRecord(
            $this->ids->nextTimelineRecordId(),
            $command->targetType,
            $command->targetReference,
            $kind,
            $command->payload,
            $command->occurredAt
        );
        $event->attachRelationship($command->relationshipReference);
        $event->attachSource($command->sourceComponent, $command->sourceReference);

        $this->timelineEvents->rememberProjected($event);
        $this->events->recordBusinessEvent(new TimelineRecordProjected($event->id(), [
            'target_type' => $command->targetType,
            'target_reference' => $command->targetReference,
            'event_kind' => $kind->value,
            'relationship_reference' => $command->relationshipReference,
        ]));

        return new RelatingActionResult('timeline-project', $event->id(), [
            'target_type' => $command->targetType,
            'target_reference' => $command->targetReference,
            'event_kind' => $kind->value,
            'occurred_at' => $event->occurredAt()->format(\DATE_ATOM),
        ]);
    }
}
