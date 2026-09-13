<?php

declare(strict_types=1);

namespace App\Snapshot\View;

final readonly class RelationshipHealthProjectionView extends AbstractArrayView
{
    protected static function surfaceName(): string
    {
        return 'relationship.health.projection';
    }

    /**
     * @return list<string>
     */
    public static function expectedKeys(): array
    {
        return ['relationshipHealth'];
    }
}
