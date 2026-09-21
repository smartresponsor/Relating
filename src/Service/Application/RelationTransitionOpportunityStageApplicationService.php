<?php

declare(strict_types=1);

namespace App\Relating\Service\Application;

use App\Relating\Command\RelationTransitionOpportunityStageCommand;
use App\Relating\Enum\RelationForecastCategory;
use App\Relating\Event\RelationOpportunityStageChanged;
use App\Relating\Exception\RelationRelatingApplicationException;
use App\Relating\Repository\RelationOpportunityRepositoryInterface;
use App\Relating\Service\RelationRelatingBusinessEventRecorderInterface;
use App\Relating\ValueObject\RelationRelatingActionResult;

final readonly class RelationTransitionOpportunityStageApplicationService
{
    public function __construct(
        private RelationOpportunityRepositoryInterface $opportunities,
        private RelationRelatingBusinessEventRecorderInterface $events,
    ) {
    }

    public function transitionOpportunityStage(RelationTransitionOpportunityStageCommand $command): RelationRelatingActionResult
    {
        $opportunity = $this->opportunities->opportunityOf($command->opportunityReference);

        if (null === $opportunity) {
            throw RelationRelatingApplicationException::missingReference('RelationOpportunity', $command->opportunityReference);
        }

        $forecastCategory = RelationForecastCategory::tryFrom($command->forecastCategory) ?? RelationForecastCategory::Pipeline;
        $opportunity->moveToStage($command->stageReference, $command->probability, $forecastCategory);
        $this->opportunities->rememberStageChanged($opportunity);

        $this->events->recordBusinessEvent(new RelationOpportunityStageChanged($opportunity->id(), [
            'stage_reference' => $command->stageReference,
            'probability' => $command->probability,
            'forecast_category' => $forecastCategory->value,
            'context' => $command->context,
        ]));

        return new RelationRelatingActionResult('opportunity-stage-transition', $opportunity->id(), [
            'stage_reference' => $command->stageReference,
            'probability' => $command->probability,
            'forecast_category' => $forecastCategory->value,
        ]);
    }
}
