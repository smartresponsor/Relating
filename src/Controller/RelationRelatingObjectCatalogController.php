<?php

declare(strict_types=1);

namespace App\Relating\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

final class RelationRelatingObjectCatalogController extends AbstractController
{
    #[Route('/relating/catalog', name: 'relating_catalog', methods: ['GET'])]
    public function __invoke(): JsonResponse
    {
        return $this->json([
            'component' => 'Relating',
            'marketCategory' => 'CRM',
            'rootObject' => 'Relationship',
            'objects' => [
                'Relationship',
                'RelationLead',
                'RelationOpportunity',
                'RelationActivity',
                'RelationTimelineRecord',
                'RelationCampaign',
                'RelationCaseRecord',
                'RelationQuoteIntent',
                'RelationObjectDefinition',
                'RelationViewDefinition',
                'RelationAutomationRule',
                'RelationAiSuggestion',
            ],
            'neighbors' => [
                'Vendoring',
                'Accessing',
                'Managing',
                'Producting',
                'Ordering',
                'Payment',
                'Shipment',
                'Messaging',
                'Projecting',
            ],
        ]);
    }
}
