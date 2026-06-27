<?php

declare(strict_types=1);

namespace App\Relating\Application\Service;

use App\Relating\Application\Command\CaptureLeadCommand;
use App\Relating\Application\Result\RelatingActionResult;
use App\Relating\Entity\Lead;
use App\Relating\Event\LeadCaptured;
use App\Relating\Repository\LeadRepositoryInterface;
use App\Relating\Service\RelatingBusinessEventRecorderInterface;
use App\Relating\Service\RelatingIdGeneratorInterface;

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
