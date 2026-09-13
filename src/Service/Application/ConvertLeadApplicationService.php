<?php

declare(strict_types=1);

namespace App\Service\Application;

use App\Command\ConvertLeadCommand;
use App\Entity\Opportunity;
use App\Entity\Relationship;
use App\Enum\RelationshipKind;
use App\Event\LeadConverted;
use App\Event\LeadLinkedToVendor;
use App\Event\LeadOpportunityOpened;
use App\Event\RelationshipStarted;
use App\Exception\RelatingApplicationException;
use App\Repository\LeadRepositoryInterface;
use App\Repository\OpportunityRepositoryInterface;
use App\Repository\RelationshipRepositoryInterface;
use App\Service\RelatingBusinessEventRecorderInterface;
use App\Service\RelatingIdGeneratorInterface;
use App\ValueObject\RelatingActionResult;

final readonly class ConvertLeadApplicationService
{
    public function __construct(
        private LeadRepositoryInterface $leads,
        private RelationshipRepositoryInterface $relationships,
        private OpportunityRepositoryInterface $opportunities,
        private RelatingIdGeneratorInterface $ids,
        private RelatingBusinessEventRecorderInterface $events,
    ) {
    }

    public function convertLead(ConvertLeadCommand $command): RelatingActionResult
    {
        $lead = $this->leads->leadOf($command->leadReference);

        if (null === $lead) {
            throw RelatingApplicationException::missingReference('Lead', $command->leadReference);
        }

        $relationship = $this->relationships->relationshipForVendor($command->vendorReference);

        if (null === $relationship) {
            $relationship = new Relationship($this->ids->nextRelationshipId(), $command->vendorReference, RelationshipKind::Prospect);
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

        $this->events->recordBusinessEvent(new LeadLinkedToVendor($lead->id(), [
            'relationship_reference' => $relationship->id(),
            'vendor_reference' => $command->vendorReference,
        ]));

        $opportunityReference = null;
        if (null !== $command->pipelineReference && null !== $command->stageReference) {
            $opportunity = new Opportunity(
                $this->ids->nextOpportunityId(),
                $relationship->id(),
                $command->pipelineReference,
                $command->stageReference,
                $command->opportunityName ?? 'Lead conversion opportunity'
            );
            $opportunity->replaceContext($command->context);
            $this->opportunities->rememberOpened($opportunity);
            $opportunityReference = $opportunity->id();
            $this->events->recordBusinessEvent(new LeadOpportunityOpened($lead->id(), [
                'opportunity_reference' => $opportunityReference,
                'relationship_reference' => $relationship->id(),
            ]));
        }

        $this->events->recordBusinessEvent(new LeadConverted($lead->id(), [
            'relationship_reference' => $relationship->id(),
            'opportunity_reference' => $opportunityReference,
        ]));

        return new RelatingActionResult('lead-conversion', $lead->id(), [
            'relationship_reference' => $relationship->id(),
            'opportunity_reference' => $opportunityReference,
            'status' => $lead->status(),
        ]);
    }
}
