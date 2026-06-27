<?php

declare(strict_types=1);

namespace App\Relating\Controller;

use App\Relating\Application\Command\ProjectTimelineCommand;
use App\Relating\Application\Service\ProjectTimelineApplicationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class ProjectTimelineController extends AbstractController
{
    #[Route('/relating/timeline/project', name: 'relating_timeline_project', methods: ['POST'])]
    public function __invoke(Request $request, ProjectTimelineApplicationService $service): JsonResponse
    {
        $payload = BusinessRequestPayload::from($request);
        $result = $service->projectTimeline(new ProjectTimelineCommand(
            targetType: $payload->requiredString('target_type'),
            targetReference: $payload->requiredString('target_reference'),
            eventKind: $payload->requiredString('event_kind'),
            relationshipReference: $payload->optionalString('relationship_reference'),
            sourceComponent: $payload->optionalString('source_component'),
            sourceReference: $payload->optionalString('source_reference'),
            payload: $payload->array('payload'),
            occurredAt: $payload->optionalDateTime('occurred_at'),
        ));

        return $this->json(BusinessResultPayload::from($result));
    }
}
