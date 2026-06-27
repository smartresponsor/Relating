<?php

declare(strict_types=1);

namespace App\Relating\Application\Service;

use App\Relating\Application\Command\ConvertLeadCommand;
use App\Relating\Application\Result\RelatingActionResult;
use App\Relating\Entity\Opportunity;
use App\Relating\Entity\Relationship;
use App\Relating\Enum\RelationshipKind;
use App\Relating\Event\LeadConverted;
use App\Relating\Event\LeadLinkedToVendor;
use App\Relating\Event\LeadOpportunityOpened;
use App\Relating\Event\RelationshipStarted;
use App\Relating\Exception\RelatingApplicationException;
use App\Relating\Repository\LeadRepositoryInterface;
use App\Relating\Repository\OpportunityRepositoryInterface;
use App\Relating\Repository\RelationshipRepositoryInterface;
use App\Relating\Service\RelatingBusinessEventRecorderInterface;
use App\Relating\Service\RelatingIdGeneratorInterface;

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

        if ($lead === null) {
            throw RelatingApplicationException::missingReference('Lead', $command->leadReference);
        }

        $relationship = $this->relationships->relationshipForVendor($command->vendorReference);

        if ($relationship === null) {
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
        if ($command->pipelineReference !== null && $command->stageReference !== null) {
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
