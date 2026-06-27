<?php

declare(strict_types=1);

namespace App\Application\Service;

use App\Application\Command\TransitionOpportunityStageCommand;
use App\Application\Result\RelatingActionResult;
use App\Enum\ForecastCategory;
use App\Event\OpportunityStageChanged;
use App\Exception\RelatingApplicationException;
use App\Repository\OpportunityRepositoryInterface;
use App\Service\RelatingBusinessEventRecorderInterface;

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

        if ($opportunity === null) {
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
