<?php

declare(strict_types=1);

namespace App\Relating\Controller;

use App\Relating\Command\RelationProjectTimelineCommand;
use App\Relating\Service\Application\RelationProjectTimelineApplicationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class RelationProjectTimelineController extends AbstractController
{
    #[Route('/relating/timeline/project', name: 'relating_timeline_project', methods: ['POST'])]
    public function __invoke(Request $request, RelationProjectTimelineApplicationService $service): JsonResponse
    {
        $payload = RelationBusinessRequestPayload::from($request);
        $result = $service->projectTimeline(new RelationProjectTimelineCommand(
            targetType: $payload->requiredString('target_type'),
            targetReference: $payload->requiredString('target_reference'),
            eventKind: $payload->requiredString('event_kind'),
            relationshipReference: $payload->optionalString('relationship_reference'),
            sourceComponent: $payload->optionalString('source_component'),
            sourceReference: $payload->optionalString('source_reference'),
            payload: $payload->array('payload'),
            occurredAt: $payload->optionalDateTime('occurred_at'),
        ));

        return $this->json(RelationBusinessResultPayload::from($result));
    }
}
