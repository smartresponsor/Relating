<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Snapshot\View\RelationAttributionView;

interface RelationCampaignAttributionServiceInterface
{
    public function rebuildAttributionForRelationship(string $relationshipReference): RelationAttributionView;
}
