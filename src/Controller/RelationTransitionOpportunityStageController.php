<?php

declare(strict_types=1);

namespace App\Relating\Controller;

use App\Relating\Command\RelationTransitionOpportunityStageCommand;
use App\Relating\Service\Application\RelationTransitionOpportunityStageApplicationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class RelationTransitionOpportunityStageController extends AbstractController
{
    #[Route('/relating/opportunity/stage/transition', name: 'relating_opportunity_stage_transition', methods: ['POST'])]
    public function __invoke(Request $request, RelationTransitionOpportunityStageApplicationService $service): JsonResponse
    {
        $payload = RelationBusinessRequestPayload::from($request);
        $result = $service->transitionOpportunityStage(new RelationTransitionOpportunityStageCommand(
            opportunityReference: $payload->requiredString('opportunity_reference'),
            stageReference: $payload->requiredString('stage_reference'),
            probability: $payload->requiredInt('probability'),
            forecastCategory: $payload->optionalString('forecast_category') ?? 'pipeline',
            context: $payload->array('context'),
        ));

        return $this->json(RelationBusinessResultPayload::from($result));
    }
}
