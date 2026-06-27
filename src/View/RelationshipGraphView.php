<?php

declare(strict_types=1);

namespace App\View;

final readonly class RelationshipGraphView extends AbstractArrayView
{
    protected static function surfaceName(): string
    {
        return 'relationship.graph';
    }

    public static function expectedKeys(): array
    {
        return ['relationshipId', 'nodes', 'edges', 'generatedAt'];
    }
}
