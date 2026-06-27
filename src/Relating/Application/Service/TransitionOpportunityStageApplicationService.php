<?php

declare(strict_types=1);

namespace App\Relating\Application\Service;

use App\Relating\Application\Command\TransitionOpportunityStageCommand;
use App\Relating\Application\Result\RelatingActionResult;
use App\Relating\Enum\ForecastCategory;
use App\Relating\Event\OpportunityStageChanged;
use App\Relating\Exception\RelatingApplicationException;
use App\Relating\Repository\OpportunityRepositoryInterface;
use App\Relating\Service\RelatingBusinessEventRecorderInterface;

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
