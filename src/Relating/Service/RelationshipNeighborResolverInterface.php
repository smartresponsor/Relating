<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Enum\NeighborComponent;
use App\Relating\Value\NeighborReference;

interface RelationshipNeighborResolverInterface
{
    /**
     * @return list<NeighborReference>
     */
    public function resolveRelationshipNeighbors(string $relationshipReference): array;

    public function hasNeighbor(string $relationshipReference, NeighborComponent $component): bool;
}
