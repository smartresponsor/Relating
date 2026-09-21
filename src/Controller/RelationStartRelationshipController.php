<?php

declare(strict_types=1);

namespace App\Relating\Controller;

use App\Relating\Command\RelationStartRelationshipCommand;
use App\Relating\Service\Application\RelationStartRelationshipApplicationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class RelationStartRelationshipController extends AbstractController
{
    #[Route('/relating/relationship/start', name: 'relating_relationship_start', methods: ['POST'])]
    public function __invoke(Request $request, RelationStartRelationshipApplicationService $service): JsonResponse
    {
        $payload = RelationBusinessRequestPayload::from($request);
        $result = $service->startRelationship(new RelationStartRelationshipCommand(
            vendorReference: $payload->requiredString('vendor_reference'),
            relationshipKind: $payload->optionalString('relationship_kind') ?? 'prospect',
            tenantReference: $payload->optionalString('tenant_reference'),
            ownerReference: $payload->optionalString('owner_reference'),
            sourceReference: $payload->optionalString('source_reference'),
            context: $payload->array('context'),
        ));

        return $this->json(RelationBusinessResultPayload::from($result));
    }
}
