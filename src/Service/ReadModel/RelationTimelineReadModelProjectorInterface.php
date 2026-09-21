<?php

declare(strict_types=1);

namespace App\Relating\Service\ReadModel;

use App\Relating\Snapshot\RelationshipTimelineReadModel;

interface RelationTimelineReadModelProjectorInterface
{
    /**
     * @param array<string, mixed> $context
     */
    public function projectRelationshipTimeline(string $relationshipReference, array $context = []): RelationshipTimelineReadModel;
}
