<?php

declare(strict_types=1);

namespace App\Service;

use App\Snapshot\View\AttributionView;

interface CampaignAttributionServiceInterface
{
    public function rebuildAttributionForRelationship(string $relationshipReference): AttributionView;
}
