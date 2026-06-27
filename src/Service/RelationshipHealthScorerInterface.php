<?php

declare(strict_types=1);

namespace App\Service;

interface RelationshipHealthScorerInterface
{
    public function scoreRelationshipHealth(string $relationshipReference): int;
}
