<?php

declare(strict_types=1);

namespace App\Relating\Controller;

use App\Relating\Command\RelationQualifyLeadCommand;
use App\Relating\Service\Application\RelationQualifyLeadApplicationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class RelationQualifyLeadController extends AbstractController
{
    #[Route('/relating/lead/qualify', name: 'relating_lead_qualify', methods: ['POST'])]
    public function __invoke(Request $request, RelationQualifyLeadApplicationService $service): JsonResponse
    {
        $payload = RelationBusinessRequestPayload::from($request);
        $result = $service->qualifyLead(new RelationQualifyLeadCommand(
            leadReference: $payload->requiredString('lead_reference'),
            score: $payload->requiredInt('score'),
            temperature: $payload->optionalString('temperature') ?? 'warm',
            context: $payload->array('context'),
        ));

        return $this->json(RelationBusinessResultPayload::from($result));
    }
}
