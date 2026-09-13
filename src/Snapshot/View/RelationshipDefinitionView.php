<?php

declare(strict_types=1);

namespace App\Snapshot\View;

final readonly class RelationshipDefinitionView extends AbstractArrayView
{
    public static function expectedKeys(): array
    {
        return ['sourceObject', 'targetObject', 'relationshipType'];
    }
}
