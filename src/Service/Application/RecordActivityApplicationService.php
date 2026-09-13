<?php

declare(strict_types=1);

namespace App\Service\Application;

use App\Command\RecordActivityCommand;
use App\Entity\Activity;
use App\Enum\ActivityDirection;
use App\Enum\ActivityType;
use App\Event\ActivityRecorded;
use App\Repository\ActivityRepositoryInterface;
use App\Service\RelatingBusinessEventRecorderInterface;
use App\Service\RelatingIdGeneratorInterface;
use App\ValueObject\RelatingActionResult;

final readonly class RecordActivityApplicationService
{
    public function __construct(
        private ActivityRepositoryInterface $activities,
        private RelatingIdGeneratorInterface $ids,
        private RelatingBusinessEventRecorderInterface $events,
    ) {
    }

    public function recordActivity(RecordActivityCommand $command): RelatingActionResult
    {
        $type = ActivityType::tryFrom($command->activityType) ?? ActivityType::Task;
        $direction = ActivityDirection::tryFrom($command->direction) ?? ActivityDirection::Internal;
        $activity = new Activity($this->ids->nextActivityId(), $type, $command->targetType, $command->targetReference, $direction);
        $activity->attachRelationship($command->relationshipReference);
        $activity->assignOwner($command->ownerReference);
        $activity->describe($command->subject, $command->body);
        $activity->schedule($command->dueAt);

        $this->activities->rememberRecorded($activity);
        $this->events->recordBusinessEvent(new ActivityRecorded($activity->id(), [
            'target_type' => $command->targetType,
            'target_reference' => $command->targetReference,
            'relationship_reference' => $command->relationshipReference,
            'activity_type' => $type->value,
            'direction' => $direction->value,
        ]));

        return new RelatingActionResult('activity-record', $activity->id(), [
            'target_type' => $command->targetType,
            'target_reference' => $command->targetReference,
            'activity_type' => $type->value,
        ]);
    }
}
