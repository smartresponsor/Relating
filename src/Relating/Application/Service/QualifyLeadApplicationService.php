<?php

declare(strict_types=1);

namespace App\Relating\Application\Service;

use App\Relating\Application\Command\QualifyLeadCommand;
use App\Relating\Application\Result\RelatingActionResult;
use App\Relating\Enum\LeadTemperature;
use App\Relating\Event\LeadQualified;
use App\Relating\Exception\RelatingApplicationException;
use App\Relating\Repository\LeadRepositoryInterface;
use App\Relating\Service\RelatingBusinessEventRecorderInterface;

final readonly class QualifyLeadApplicationService
{
    public function __construct(
        private LeadRepositoryInterface $leads,
        private RelatingBusinessEventRecorderInterface $events,
    ) {
    }

    public function qualifyLead(QualifyLeadCommand $command): RelatingActionResult
    {
        $lead = $this->leads->leadOf($command->leadReference);

        if ($lead === null) {
            throw RelatingApplicationException::missingReference('Lead', $command->leadReference);
        }

        $temperature = LeadTemperature::tryFrom($command->temperature) ?? LeadTemperature::Warm;
        $lead->qualify($command->score, $temperature);
        $this->leads->rememberQualified($lead);

        $this->events->recordBusinessEvent(new LeadQualified($lead->id(), [
            'score' => $command->score,
            'temperature' => $temperature->value,
            'context' => $command->context,
        ]));

        return new RelatingActionResult('lead-qualification', $lead->id(), [
            'score' => $lead->score(),
            'temperature' => $temperature->value,
            'status' => $lead->status(),
        ]);
    }
}
