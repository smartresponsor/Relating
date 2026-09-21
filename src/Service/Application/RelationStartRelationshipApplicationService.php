<?php

declare(strict_types=1);

namespace App\Relating\Service\Application;

use App\Relating\Command\RelationStartRelationshipCommand;
use App\Relating\Entity\Relationship;
use App\Relating\Enum\RelationshipKind;
use App\Relating\Event\RelationshipOwnerAssigned;
use App\Relating\Event\RelationshipStarted;
use App\Relating\Repository\RelationshipRepositoryInterface;
use App\Relating\Service\RelationRelatingBusinessEventRecorderInterface;
use App\Relating\Service\RelationRelatingIdGeneratorInterface;
use App\Relating\ValueObject\RelationRelatingActionResult;

final readonly class RelationStartRelationshipApplicationService
{
    public function __construct(
        private RelationshipRepositoryInterface $relationships,
        private RelationRelatingIdGeneratorInterface $ids,
        private RelationRelatingBusinessEventRecorderInterface $events,
    ) {
    }

    public function startRelationship(RelationStartRelationshipCommand $command): RelationRelatingActionResult
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

        return new RelationRelatingActionResult('relationship-start', $relationship->id(), [
            'vendor_reference' => $relationship->vendorReference(),
            'relationship_kind' => $relationship->kind(),
            'lifecycle_stage' => $relationship->lifecycleStage(),
        ]);
    }
}
