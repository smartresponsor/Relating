<?php

declare(strict_types=1);

namespace App\Service\Application;

use App\Command\QualifyLeadCommand;
use App\Enum\LeadTemperature;
use App\Event\LeadQualified;
use App\Exception\RelatingApplicationException;
use App\Repository\LeadRepositoryInterface;
use App\Service\RelatingBusinessEventRecorderInterface;
use App\ValueObject\RelatingActionResult;

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

        if (null === $lead) {
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
