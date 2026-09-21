<?php

declare(strict_types=1);

namespace App\Relating\Service\Application;

use App\Relating\Command\RelationCaptureLeadCommand;
use App\Relating\Entity\RelationLead;
use App\Relating\Event\RelationLeadCaptured;
use App\Relating\Repository\RelationLeadRepositoryInterface;
use App\Relating\Service\RelationRelatingBusinessEventRecorderInterface;
use App\Relating\Service\RelationRelatingIdGeneratorInterface;
use App\Relating\ValueObject\RelationRelatingActionResult;

final readonly class RelationCaptureLeadApplicationService
{
    public function __construct(
        private RelationLeadRepositoryInterface $leads,
        private RelationRelatingIdGeneratorInterface $ids,
        private RelationRelatingBusinessEventRecorderInterface $events,
    ) {
    }

    public function captureLead(RelationCaptureLeadCommand $command): RelationRelatingActionResult
    {
        $lead = new RelationLead($this->ids->nextLeadId(), $command->payload);
        $lead->assignTenant($command->tenantReference);
        $lead->identify($command->displayName, $command->companyName, $command->email, $command->phone);
        $lead->setSourceReference($command->sourceCode);

        $this->leads->rememberCaptured($lead);
        $this->events->recordBusinessEvent(new RelationLeadCaptured($lead->id(), [
            'source_code' => $command->sourceCode,
            'email' => $command->email,
            'company_name' => $command->companyName,
        ]));

        return new RelationRelatingActionResult('lead-capture', $lead->id(), [
            'source_code' => $command->sourceCode,
            'status' => $lead->status(),
        ]);
    }
}
