<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\View\AttributionView;

interface CampaignAttributionServiceInterface
{
    public function rebuildAttributionForRelationship(string $relationshipReference): AttributionView;
}
