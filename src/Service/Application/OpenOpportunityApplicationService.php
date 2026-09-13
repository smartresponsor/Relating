<?php

declare(strict_types=1);

namespace App\Service\Application;

use App\Command\OpenOpportunityCommand;
use App\Entity\Opportunity;
use App\Event\OpportunityOpened;
use App\Exception\RelatingApplicationException;
use App\Repository\OpportunityRepositoryInterface;
use App\Repository\RelationshipRepositoryInterface;
use App\Service\RelatingBusinessEventRecorderInterface;
use App\Service\RelatingIdGeneratorInterface;
use App\ValueObject\RelatingActionResult;

final readonly class OpenOpportunityApplicationService
{
    public function __construct(
        private RelationshipRepositoryInterface $relationships,
        private OpportunityRepositoryInterface $opportunities,
        private RelatingIdGeneratorInterface $ids,
        private RelatingBusinessEventRecorderInterface $events,
    ) {
    }

    public function openOpportunity(OpenOpportunityCommand $command): RelatingActionResult
    {
        $relationship = $this->relationships->relationshipOf($command->relationshipReference);

        if (null === $relationship) {
            throw RelatingApplicationException::missingReference('Relationship', $command->relationshipReference);
        }

        $opportunity = new Opportunity(
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
        $this->events->recordBusinessEvent(new OpportunityOpened($opportunity->id(), [
            'relationship_reference' => $command->relationshipReference,
            'pipeline_reference' => $command->pipelineReference,
            'stage_reference' => $command->stageReference,
            'product_reference' => $command->productReference,
        ]));

        return new RelatingActionResult('opportunity-open', $opportunity->id(), [
            'relationship_reference' => $command->relationshipReference,
            'status' => $opportunity->status(),
        ]);
    }
}
