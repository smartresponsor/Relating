<?php

declare(strict_types=1);


namespace App\Service\ReadModel;

use App\ReadModel\RelationshipTimelineReadModel;

interface TimelineReadModelProjectorInterface
{
    /**
     * @param array<string, mixed> $context
     */
    public function projectRelationshipTimeline(string $relationshipReference, array $context = []): RelationshipTimelineReadModel;
}
