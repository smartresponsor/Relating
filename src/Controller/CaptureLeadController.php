<?php

declare(strict_types=1);

namespace App\Controller;

use App\Command\CaptureLeadCommand;
use App\Service\Application\CaptureLeadApplicationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class CaptureLeadController extends AbstractController
{
    #[Route('/relating/lead/capture', name: 'relating_lead_capture', methods: ['POST'])]
    public function __invoke(Request $request, CaptureLeadApplicationService $service): JsonResponse
    {
        $payload = BusinessRequestPayload::from($request);
        $result = $service->captureLead(new CaptureLeadCommand(
            sourceCode: $payload->requiredString('source_code'),
            payload: $payload->array('payload'),
            tenantReference: $payload->optionalString('tenant_reference'),
            displayName: $payload->optionalString('display_name'),
            companyName: $payload->optionalString('company_name'),
            email: $payload->optionalString('email'),
            phone: $payload->optionalString('phone'),
        ));

        return $this->json(BusinessResultPayload::from($result));
    }
}
