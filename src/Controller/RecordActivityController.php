<?php

declare(strict_types=1);

namespace App\Controller;

use App\Command\RecordActivityCommand;
use App\Service\Application\RecordActivityApplicationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class RecordActivityController extends AbstractController
{
    #[Route('/relating/activity/record', name: 'relating_activity_record', methods: ['POST'])]
    public function __invoke(Request $request, RecordActivityApplicationService $service): JsonResponse
    {
        $payload = BusinessRequestPayload::from($request);
        $result = $service->recordActivity(new RecordActivityCommand(
            targetType: $payload->requiredString('target_type'),
            targetReference: $payload->requiredString('target_reference'),
            activityType: $payload->optionalString('activity_type') ?? 'task',
            direction: $payload->optionalString('direction') ?? 'internal',
            relationshipReference: $payload->optionalString('relationship_reference'),
            ownerReference: $payload->optionalString('owner_reference'),
            subject: $payload->optionalString('subject'),
            body: $payload->optionalString('body'),
            dueAt: $payload->optionalDateTime('due_at'),
            payload: $payload->array('payload'),
        ));

        return $this->json(BusinessResultPayload::from($result));
    }
}
