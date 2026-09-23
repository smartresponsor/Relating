<?php

declare(strict_types=1);

namespace App\Relating\Service\Application;

use App\Relating\Command\RelationOpenOpportunityCommand;
use App\Relating\Entity\RelationOpportunityEntity;
use App\Relating\Event\RelationOpportunityOpened;
use App\Relating\Exception\RelationRelatingApplicationException;
use App\Relating\Repository\RelationOpportunityRepositoryInterface;
use App\Relating\Repository\RelationshipRepositoryInterface;
use App\Relating\Service\RelationRelatingBusinessEventRecorderInterface;
use App\Relating\Service\RelationRelatingIdGeneratorInterface;
use App\Relating\ValueObject\RelationRelatingActionResult;

final readonly class RelationOpenOpportunityApplicationService
{
    public function __construct(
        private RelationshipRepositoryInterface $relationships,
        private RelationOpportunityRepositoryInterface $opportunities,
        private RelationRelatingIdGeneratorInterface $ids,
        private RelationRelatingBusinessEventRecorderInterface $events,
    ) {
    }

    public function openOpportunity(RelationOpenOpportunityCommand $command): RelationRelatingActionResult
    {
        $relationship = $this->relationships->relationshipOf($command->relationshipReference);

        if (null === $relationship) {
            throw RelationRelatingApplicationException::missingReference('Relationship', $command->relationshipReference);
        }

        $opportunity = new RelationOpportunityEntity(
            $this->ids->nextOpportunityId(),
            $command->relationshipReference,
            $command->pipelineReference,
            $command->stageReference,
            $command->name
        );
        $opportunity->assignTenant($command->tenantReference);
        $opportunity->setAmount($command->currency, $command->amountMinor);
        $opportunity->setPrimaryProductReference($command->productReference);
        $opportunity->replaceContext($command->context);

        $this->opportunities->rememberOpened($opportunity);
        $this->events->recordBusinessEvent(new RelationOpportunityOpened($opportunity->id(), [
            'relationship_reference' => $command->relationshipReference,
            'pipeline_reference' => $command->pipelineReference,
            'stage_reference' => $command->stageReference,
            'product_reference' => $command->productReference,
        ]));

        return new RelationRelatingActionResult('opportunity-open', $opportunity->id(), [
            'relationship_reference' => $command->relationshipReference,
            'status' => $opportunity->status(),
        ]);
    }
}
