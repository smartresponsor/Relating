<?php

declare(strict_types=1);

namespace App\Service;

use App\Enum\NeighborComponent;
use App\ValueObject\NeighborReference;

interface RelationshipNeighborResolverInterface
{
    /**
     * @return list<NeighborReference>
     */
    public function resolveRelationshipNeighbors(string $relationshipReference): array;

    public function hasNeighbor(string $relationshipReference, NeighborComponent $component): bool;
}
