<?php

declare(strict_types=1);

namespace App\Controller;

use App\Command\OpenOpportunityCommand;
use App\Service\Application\OpenOpportunityApplicationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class OpenOpportunityController extends AbstractController
{
    #[Route('/relating/opportunity/open', name: 'relating_opportunity_open', methods: ['POST'])]
    public function __invoke(Request $request, OpenOpportunityApplicationService $service): JsonResponse
    {
        $payload = BusinessRequestPayload::from($request);
        $result = $service->openOpportunity(new OpenOpportunityCommand(
            relationshipReference: $payload->requiredString('relationship_reference'),
            pipelineReference: $payload->requiredString('pipeline_reference'),
            stageReference: $payload->requiredString('stage_reference'),
            name: $payload->requiredString('name'),
            tenantReference: $payload->optionalString('tenant_reference'),
            productReference: $payload->optionalString('product_reference'),
            currency: $payload->optionalString('currency') ?? 'USD',
            amountMinor: $payload->optionalInt('amount_minor') ?? 0,
            context: $payload->array('context'),
        ));

        return $this->json(BusinessResultPayload::from($result));
    }
}
