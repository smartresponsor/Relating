<?php

declare(strict_types=1);

namespace App\Relating\Application\Service;

use App\Relating\Application\Command\StartRelationshipCommand;
use App\Relating\Application\Result\RelatingActionResult;
use App\Relating\Entity\Relationship;
use App\Relating\Enum\RelationshipKind;
use App\Relating\Event\RelationshipOwnerAssigned;
use App\Relating\Event\RelationshipStarted;
use App\Relating\Repository\RelationshipRepositoryInterface;
use App\Relating\Service\RelatingBusinessEventRecorderInterface;
use App\Relating\Service\RelatingIdGeneratorInterface;

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

        if ($command->ownerReference !== null) {
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
