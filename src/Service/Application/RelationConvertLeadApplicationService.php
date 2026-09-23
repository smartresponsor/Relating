<?php

declare(strict_types=1);

namespace App\Relating\Service\Application;

use App\Relating\Command\RelationConvertLeadCommand;
use App\Relating\Entity\RelationOpportunityEntity;
use App\Relating\Entity\RelationshipEntity;
use App\Relating\Enum\RelationshipKind;
use App\Relating\Event\RelationLeadConverted;
use App\Relating\Event\RelationLeadLinkedToVendor;
use App\Relating\Event\RelationLeadOpportunityOpened;
use App\Relating\Event\RelationshipStarted;
use App\Relating\Exception\RelationRelatingApplicationException;
use App\Relating\Repository\RelationLeadRepositoryInterface;
use App\Relating\Repository\RelationOpportunityRepositoryInterface;
use App\Relating\Repository\RelationshipRepositoryInterface;
use App\Relating\Service\RelationRelatingBusinessEventRecorderInterface;
use App\Relating\Service\RelationRelatingIdGeneratorInterface;
use App\Relating\ValueObject\RelationRelatingActionResult;

final readonly class RelationConvertLeadApplicationService
{
    public function __construct(
        private RelationLeadRepositoryInterface $leads,
        private RelationshipRepositoryInterface $relationships,
        private RelationOpportunityRepositoryInterface $opportunities,
        private RelationRelatingIdGeneratorInterface $ids,
        private RelationRelatingBusinessEventRecorderInterface $events,
    ) {
    }

    public function convertLead(RelationConvertLeadCommand $command): RelationRelatingActionResult
    {
        $lead = $this->leads->leadOf($command->leadReference);

        if (null === $lead) {
            throw RelationRelatingApplicationException::missingReference('RelationLead', $command->leadReference);
        }

        $relationship = $this->relationships->relationshipForVendor($command->vendorReference);

        if (null === $relationship) {
            $relationship = new RelationshipEntity($this->ids->nextRelationshipId(), $command->vendorReference, RelationshipKind::Prospect);
            $relationship->replaceContext($command->context);
            $relationship->markTouch();
            $this->relationships->rememberStarted($relationship);
            $this->events->recordBusinessEvent(new RelationshipStarted($relationship->id(), [
                'vendor_reference' => $command->vendorReference,
                'source' => 'lead-conversion',
            ]));
        }

        $lead->linkRelationship($relationship->id());
        $lead->markConverted($relationship->id());
        $this->leads->rememberConverted($lead);

        $this->events->recordBusinessEvent(new RelationLeadLinkedToVendor($lead->id(), [
            'relationship_reference' => $relationship->id(),
            'vendor_reference' => $command->vendorReference,
        ]));

        $opportunityReference = null;
        if (null !== $command->pipelineReference && null !== $command->stageReference) {
            $opportunity = new RelationOpportunityEntity(
                $this->ids->nextOpportunityId(),
                $relationship->id(),
                $command->pipelineReference,
                $command->stageReference,
                $command->opportunityName ?? 'RelationLead conversion opportunity'
            );
            $opportunity->replaceContext($command->context);
            $this->opportunities->rememberOpened($opportunity);
            $opportunityReference = $opportunity->id();
            $this->events->recordBusinessEvent(new RelationLeadOpportunityOpened($lead->id(), [
                'opportunity_reference' => $opportunityReference,
                'relationship_reference' => $relationship->id(),
            ]));
        }

        $this->events->recordBusinessEvent(new RelationLeadConverted($lead->id(), [
            'relationship_reference' => $relationship->id(),
            'opportunity_reference' => $opportunityReference,
        ]));

        return new RelationRelatingActionResult('lead-conversion', $lead->id(), [
            'relationship_reference' => $relationship->id(),
            'opportunity_reference' => $opportunityReference,
            'status' => $lead->status(),
        ]);
    }
}
