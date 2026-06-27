<?php

declare(strict_types=1);

namespace App\Controller;

use App\Application\Command\TransitionOpportunityStageCommand;
use App\Application\Service\TransitionOpportunityStageApplicationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class TransitionOpportunityStageController extends AbstractController
{
    #[Route('/relating/opportunity/stage-transition', name: 'relating_opportunity_stage_transition', methods: ['POST'])]
    public function __invoke(Request $request, TransitionOpportunityStageApplicationService $service): JsonResponse
    {
        $payload = BusinessRequestPayload::from($request);
        $result = $service->transitionOpportunityStage(new TransitionOpportunityStageCommand(
            opportunityReference: $payload->requiredString('opportunity_reference'),
            stageReference: $payload->requiredString('stage_reference'),
            probability: $payload->requiredInt('probability'),
            forecastCategory: $payload->optionalString('forecast_category') ?? 'pipeline',
            context: $payload->array('context'),
        ));

        return $this->json(BusinessResultPayload::from($result));
    }
}
