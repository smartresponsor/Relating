<?php

declare(strict_types=1);


namespace App\Relating\Service\ReadModel;

use App\Relating\ReadModel\RelationshipHealthReadModel;

interface RelationshipHealthReadModelProjectorInterface
{
    /**
     * @param array<string, mixed> $context
     */
    public function projectRelationshipHealth(string $relationshipReference, array $context = []): RelationshipHealthReadModel;
}
