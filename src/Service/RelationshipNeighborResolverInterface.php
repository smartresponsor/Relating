<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Enum\RelationNeighborComponent;
use App\Relating\ValueObject\RelationNeighborReference;

interface RelationshipNeighborResolverInterface
{
    /**
     * @return list<RelationNeighborReference>
     */
    public function resolveRelationshipNeighbors(string $relationshipReference): array;

    public function hasNeighbor(string $relationshipReference, RelationNeighborComponent $component): bool;
}
