<?php

declare(strict_types=1);

namespace App\Relating\Service\Application;

use App\Relating\Command\RelationRecordActivityCommand;
use App\Relating\Entity\RelationActivity;
use App\Relating\Enum\RelationActivityDirection;
use App\Relating\Enum\RelationActivityType;
use App\Relating\Event\RelationActivityRecorded;
use App\Relating\Repository\RelationActivityRepositoryInterface;
use App\Relating\Service\RelationRelatingBusinessEventRecorderInterface;
use App\Relating\Service\RelationRelatingIdGeneratorInterface;
use App\Relating\ValueObject\RelationRelatingActionResult;

final readonly class RelationRecordActivityApplicationService
{
    public function __construct(
        private RelationActivityRepositoryInterface $activities,
        private RelationRelatingIdGeneratorInterface $ids,
        private RelationRelatingBusinessEventRecorderInterface $events,
    ) {
    }

    public function recordActivity(RelationRecordActivityCommand $command): RelationRelatingActionResult
    {
        $type = RelationActivityType::tryFrom($command->activityType) ?? RelationActivityType::Task;
        $direction = RelationActivityDirection::tryFrom($command->direction) ?? RelationActivityDirection::Internal;
        $activity = new RelationActivity($this->ids->nextActivityId(), $type, $command->targetType, $command->targetReference, $direction);
        $activity->attachRelationship($command->relationshipReference);
        $activity->assignOwner($command->ownerReference);
        $activity->describe($command->subject, $command->body);
        $activity->schedule($command->dueAt);

        $this->activities->rememberRecorded($activity);
        $this->events->recordBusinessEvent(new RelationActivityRecorded($activity->id(), [
            'target_type' => $command->targetType,
            'target_reference' => $command->targetReference,
            'relationship_reference' => $command->relationshipReference,
            'activity_type' => $type->value,
            'direction' => $direction->value,
        ]));

        return new RelationRelatingActionResult('activity-record', $activity->id(), [
            'target_type' => $command->targetType,
            'target_reference' => $command->targetReference,
            'activity_type' => $type->value,
        ]);
    }
}
