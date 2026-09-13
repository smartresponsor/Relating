<?php

declare(strict_types=1);

namespace App\Service\Application;

use App\Command\TransitionOpportunityStageCommand;
use App\Enum\ForecastCategory;
use App\Event\OpportunityStageChanged;
use App\Exception\RelatingApplicationException;
use App\Repository\OpportunityRepositoryInterface;
use App\Service\RelatingBusinessEventRecorderInterface;
use App\ValueObject\RelatingActionResult;

final readonly class TransitionOpportunityStageApplicationService
{
    public function __construct(
        private OpportunityRepositoryInterface $opportunities,
        private RelatingBusinessEventRecorderInterface $events,
    ) {
    }

    public function transitionOpportunityStage(TransitionOpportunityStageCommand $command): RelatingActionResult
    {
        $opportunity = $this->opportunities->opportunityOf($command->opportunityReference);

        if (null === $opportunity) {
            throw RelatingApplicationException::missingReference('Opportunity', $command->opportunityReference);
        }

        $forecastCategory = ForecastCategory::tryFrom($command->forecastCategory) ?? ForecastCategory::Pipeline;
        $opportunity->moveToStage($command->stageReference, $command->probability, $forecastCategory);
        $this->opportunities->rememberStageChanged($opportunity);

        $this->events->recordBusinessEvent(new OpportunityStageChanged($opportunity->id(), [
            'stage_reference' => $command->stageReference,
            'probability' => $command->probability,
            'forecast_category' => $forecastCategory->value,
            'context' => $command->context,
        ]));

        return new RelatingActionResult('opportunity-stage-transition', $opportunity->id(), [
            'stage_reference' => $command->stageReference,
            'probability' => $command->probability,
            'forecast_category' => $forecastCategory->value,
        ]);
    }
}
