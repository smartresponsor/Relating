<?php

declare(strict_types=1);

namespace App\Relating\Controller;

use App\Relating\Command\RelationConvertLeadCommand;
use App\Relating\Service\Application\RelationConvertLeadApplicationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class RelationConvertLeadController extends AbstractController
{
    #[Route('/relating/lead/convert', name: 'relating_lead_convert', methods: ['POST'])]
    public function __invoke(Request $request, RelationConvertLeadApplicationService $service): JsonResponse
    {
        $payload = RelationBusinessRequestPayload::from($request);
        $result = $service->convertLead(new RelationConvertLeadCommand(
            leadReference: $payload->requiredString('lead_reference'),
            vendorReference: $payload->requiredString('vendor_reference'),
            pipelineReference: $payload->optionalString('pipeline_reference'),
            stageReference: $payload->optionalString('stage_reference'),
            opportunityName: $payload->optionalString('opportunity_name'),
            context: $payload->array('context'),
        ));

        return $this->json(RelationBusinessResultPayload::from($result));
    }
}
