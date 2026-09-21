<?php

declare(strict_types=1);

namespace App\Relating\Controller;

use App\Relating\Command\RelationReviewAiSuggestionCommand;
use App\Relating\Service\Application\RelationReviewAiSuggestionApplicationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class RelationReviewAiSuggestionController extends AbstractController
{
    #[Route('/relating/ai/suggestion/review', name: 'relating_ai_suggestion_review', methods: ['POST'])]
    public function __invoke(Request $request, RelationReviewAiSuggestionApplicationService $service): JsonResponse
    {
        $payload = RelationBusinessRequestPayload::from($request);
        $result = $service->reviewAiSuggestion(new RelationReviewAiSuggestionCommand(
            suggestionReference: $payload->requiredString('suggestion_reference'),
            reviewerReference: $payload->requiredString('reviewer_reference'),
            decision: $payload->requiredString('decision'),
            reason: $payload->optionalString('reason'),
            context: $payload->array('context'),
        ));

        return $this->json(RelationBusinessResultPayload::from($result));
    }
}
