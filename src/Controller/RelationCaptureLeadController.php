<?php

declare(strict_types=1);

namespace App\Relating\Controller;

use App\Relating\Command\RelationCaptureLeadCommand;
use App\Relating\Service\Application\RelationCaptureLeadApplicationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class RelationCaptureLeadController extends AbstractController
{
    #[Route('/relating/lead/capture', name: 'relating_lead_capture', methods: ['POST'])]
    public function __invoke(Request $request, RelationCaptureLeadApplicationService $service): JsonResponse
    {
        $payload = RelationBusinessRequestPayload::from($request);
        $result = $service->captureLead(new RelationCaptureLeadCommand(
            sourceCode: $payload->requiredString('source_code'),
            payload: $payload->array('payload'),
            tenantReference: $payload->optionalString('tenant_reference'),
            displayName: $payload->optionalString('display_name'),
            companyName: $payload->optionalString('company_name'),
            email: $payload->optionalString('email'),
            phone: $payload->optionalString('phone'),
        ));

        return $this->json(RelationBusinessResultPayload::from($result));
    }
}
