<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Entity\Relationship;

interface RelationshipStarterInterface
{
    /**
     * @param array<string, mixed> $context
     */
    public function startRelationshipForVendor(string $vendorReference, string $relationshipKind, array $context = []): Relationship;
}
