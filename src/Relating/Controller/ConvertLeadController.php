<?php

declare(strict_types=1);

namespace App\Relating\Controller;

use App\Relating\Application\Command\ConvertLeadCommand;
use App\Relating\Application\Service\ConvertLeadApplicationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class ConvertLeadController extends AbstractController
{
    #[Route('/relating/lead/convert', name: 'relating_lead_convert', methods: ['POST'])]
    public function __invoke(Request $request, ConvertLeadApplicationService $service): JsonResponse
    {
        $payload = BusinessRequestPayload::from($request);
        $result = $service->convertLead(new ConvertLeadCommand(
            leadReference: $payload->requiredString('lead_reference'),
            vendorReference: $payload->requiredString('vendor_reference'),
            pipelineReference: $payload->optionalString('pipeline_reference'),
            stageReference: $payload->optionalString('stage_reference'),
            opportunityName: $payload->optionalString('opportunity_name'),
            context: $payload->array('context'),
        ));

        return $this->json(BusinessResultPayload::from($result));
    }
}
