<?php

declare(strict_types=1);

namespace App\Service\Application;

use App\Command\CaptureLeadCommand;
use App\Entity\Lead;
use App\Event\LeadCaptured;
use App\Repository\LeadRepositoryInterface;
use App\Service\RelatingBusinessEventRecorderInterface;
use App\Service\RelatingIdGeneratorInterface;
use App\ValueObject\RelatingActionResult;

final readonly class CaptureLeadApplicationService
{
    public function __construct(
        private LeadRepositoryInterface $leads,
        private RelatingIdGeneratorInterface $ids,
        private RelatingBusinessEventRecorderInterface $events,
    ) {
    }

    public function captureLead(CaptureLeadCommand $command): RelatingActionResult
    {
        $lead = new Lead($this->ids->nextLeadId(), $command->payload);
        $lead->assignTenant($command->tenantReference);
        $lead->identify($command->displayName, $command->companyName, $command->email, $command->phone);
        $lead->setSourceReference($command->sourceCode);

        $this->leads->rememberCaptured($lead);
        $this->events->recordBusinessEvent(new LeadCaptured($lead->id(), [
            'source_code' => $command->sourceCode,
            'email' => $command->email,
            'company_name' => $command->companyName,
        ]));

        return new RelatingActionResult('lead-capture', $lead->id(), [
            'source_code' => $command->sourceCode,
            'status' => $lead->status(),
        ]);
    }
}
