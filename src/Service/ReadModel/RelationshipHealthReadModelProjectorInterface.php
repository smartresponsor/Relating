<?php

declare(strict_types=1);

namespace App\Service\ReadModel;

use App\Snapshot\RelationshipHealthReadModel;

interface RelationshipHealthReadModelProjectorInterface
{
    /**
     * @param array<string, mixed> $context
     */
    public function projectRelationshipHealth(string $relationshipReference, array $context = []): RelationshipHealthReadModel;
}
