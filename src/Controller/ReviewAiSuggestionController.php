<?php

declare(strict_types=1);

namespace App\Controller;

use App\Command\ReviewAiSuggestionCommand;
use App\Service\Application\ReviewAiSuggestionApplicationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

final class ReviewAiSuggestionController extends AbstractController
{
    #[Route('/relating/ai/suggestion/review', name: 'relating_ai_suggestion_review', methods: ['POST'])]
    public function __invoke(Request $request, ReviewAiSuggestionApplicationService $service): JsonResponse
    {
        $payload = BusinessRequestPayload::from($request);
        $result = $service->reviewAiSuggestion(new ReviewAiSuggestionCommand(
            suggestionReference: $payload->requiredString('suggestion_reference'),
            reviewerReference: $payload->requiredString('reviewer_reference'),
            decision: $payload->requiredString('decision'),
            reason: $payload->optionalString('reason'),
            context: $payload->array('context'),
        ));

        return $this->json(BusinessResultPayload::from($result));
    }
}
