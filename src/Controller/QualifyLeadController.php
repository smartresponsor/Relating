<?php

declare(strict_types=1);

namespace App\Controller;

use App\Application\Command\QualifyLeadCommand;
use App\Application\Service\QualifyLeadApplicationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class QualifyLeadController extends AbstractController
{
    #[Route('/relating/lead/qualify', name: 'relating_lead_qualify', methods: ['POST'])]
    public function __invoke(Request $request, QualifyLeadApplicationService $service): JsonResponse
    {
        $payload = BusinessRequestPayload::from($request);
        $result = $service->qualifyLead(new QualifyLeadCommand(
            leadReference: $payload->requiredString('lead_reference'),
            score: $payload->requiredInt('score'),
            temperature: $payload->optionalString('temperature') ?? 'warm',
            context: $payload->array('context'),
        ));

        return $this->json(BusinessResultPayload::from($result));
    }
}
