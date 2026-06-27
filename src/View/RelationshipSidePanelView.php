<?php

declare(strict_types=1);

namespace App\View;

final readonly class RelationshipSidePanelView extends AbstractArrayView
{
    public static function expectedKeys(): array
    {
        return ['relationshipId', 'summary', 'nextActions', 'signals'];
    }
}
