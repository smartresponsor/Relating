<?php

declare(strict_types=1);

namespace App\Relating\Service\Application;

use App\Relating\Command\RelationQualifyLeadCommand;
use App\Relating\Enum\RelationLeadTemperature;
use App\Relating\Event\RelationLeadQualified;
use App\Relating\Exception\RelationRelatingApplicationException;
use App\Relating\Repository\RelationLeadRepositoryInterface;
use App\Relating\Service\RelationRelatingBusinessEventRecorderInterface;
use App\Relating\ValueObject\RelationRelatingActionResult;

final readonly class RelationQualifyLeadApplicationService
{
    public function __construct(
        private RelationLeadRepositoryInterface $leads,
        private RelationRelatingBusinessEventRecorderInterface $events,
    ) {
    }

    public function qualifyLead(RelationQualifyLeadCommand $command): RelationRelatingActionResult
    {
        $lead = $this->leads->leadOf($command->leadReference);

        if (null === $lead) {
            throw RelationRelatingApplicationException::missingReference('RelationLead', $command->leadReference);
        }

        $temperature = RelationLeadTemperature::tryFrom($command->temperature) ?? RelationLeadTemperature::Warm;
        $lead->qualify($command->score, $temperature);
        $this->leads->rememberQualified($lead);

        $this->events->recordBusinessEvent(new RelationLeadQualified($lead->id(), [
            'score' => $command->score,
            'temperature' => $temperature->value,
            'context' => $command->context,
        ]));

        return new RelationRelatingActionResult('lead-qualification', $lead->id(), [
            'score' => $lead->score(),
            'temperature' => $temperature->value,
            'status' => $lead->status(),
        ]);
    }
}
