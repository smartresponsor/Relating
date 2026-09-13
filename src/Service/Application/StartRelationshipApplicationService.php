<?php

declare(strict_types=1);

namespace App\Service\Application;

use App\Command\StartRelationshipCommand;
use App\Entity\Relationship;
use App\Enum\RelationshipKind;
use App\Event\RelationshipOwnerAssigned;
use App\Event\RelationshipStarted;
use App\Repository\RelationshipRepositoryInterface;
use App\Service\RelatingBusinessEventRecorderInterface;
use App\Service\RelatingIdGeneratorInterface;
use App\ValueObject\RelatingActionResult;

final readonly class StartRelationshipApplicationService
{
    public function __construct(
        private RelationshipRepositoryInterface $relationships,
        private RelatingIdGeneratorInterface $ids,
        private RelatingBusinessEventRecorderInterface $events,
    ) {
    }

    public function startRelationship(StartRelationshipCommand $command): RelatingActionResult
    {
        $kind = RelationshipKind::tryFrom($command->relationshipKind) ?? RelationshipKind::Prospect;
        $relationship = new Relationship($this->ids->nextRelationshipId(), $command->vendorReference, $kind);
        $relationship->assignTenant($command->tenantReference);
        $relationship->assignOwner($command->ownerReference);
        $relationship->setSourceReference($command->sourceReference);
        $relationship->replaceContext($command->context);
        $relationship->markTouch();

        $this->relationships->rememberStarted($relationship);
        $this->events->recordBusinessEvent(new RelationshipStarted($relationship->id(), [
            'vendor_reference' => $command->vendorReference,
            'relationship_kind' => $kind->value,
            'source_reference' => $command->sourceReference,
        ]));

        if (null !== $command->ownerReference) {
            $this->events->recordBusinessEvent(new RelationshipOwnerAssigned($relationship->id(), [
                'owner_reference' => $command->ownerReference,
            ]));
        }

        return new RelatingActionResult('relationship-start', $relationship->id(), [
            'vendor_reference' => $relationship->vendorReference(),
            'relationship_kind' => $relationship->kind(),
            'lifecycle_stage' => $relationship->lifecycleStage(),
        ]);
    }
}
