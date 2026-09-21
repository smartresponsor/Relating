<?php

declare(strict_types=1);

namespace App\Relating\Controller;

use App\Relating\Command\RelationOpenOpportunityCommand;
use App\Relating\Service\Application\RelationOpenOpportunityApplicationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class RelationOpenOpportunityController extends AbstractController
{
    #[Route('/relating/opportunity/open', name: 'relating_opportunity_open', methods: ['POST'])]
    public function __invoke(Request $request, RelationOpenOpportunityApplicationService $service): JsonResponse
    {
        $payload = RelationBusinessRequestPayload::from($request);
        $result = $service->openOpportunity(new RelationOpenOpportunityCommand(
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

        return $this->json(RelationBusinessResultPayload::from($result));
    }
}
