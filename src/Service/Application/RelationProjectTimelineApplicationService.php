<?php

declare(strict_types=1);

namespace App\Relating\Service\Application;

use App\Relating\Command\RelationProjectTimelineCommand;
use App\Relating\Entity\RelationTimelineRecord;
use App\Relating\Enum\RelationTimelineRecordKind;
use App\Relating\Event\RelationTimelineRecordProjected;
use App\Relating\Repository\RelationTimelineRecordRepositoryInterface;
use App\Relating\Service\RelationRelatingBusinessEventRecorderInterface;
use App\Relating\Service\RelationRelatingIdGeneratorInterface;
use App\Relating\ValueObject\RelationRelatingActionResult;

final readonly class RelationProjectTimelineApplicationService
{
    public function __construct(
        private RelationTimelineRecordRepositoryInterface $timelineEvents,
        private RelationRelatingIdGeneratorInterface $ids,
        private RelationRelatingBusinessEventRecorderInterface $events,
    ) {
    }

    public function projectTimeline(RelationProjectTimelineCommand $command): RelationRelatingActionResult
    {
        $kind = RelationTimelineRecordKind::tryFrom($command->eventKind) ?? RelationTimelineRecordKind::NeighborSignalCaptured;
        $event = new RelationTimelineRecord(
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
        $this->events->recordBusinessEvent(new RelationTimelineRecordProjected($event->id(), [
            'target_type' => $command->targetType,
            'target_reference' => $command->targetReference,
            'event_kind' => $kind->value,
            'relationship_reference' => $command->relationshipReference,
        ]));

        return new RelationRelatingActionResult('timeline-project', $event->id(), [
            'target_type' => $command->targetType,
            'target_reference' => $command->targetReference,
            'event_kind' => $kind->value,
            'occurred_at' => $event->occurredAt()->format(\DATE_ATOM),
        ]);
    }
}
