<?php

declare(strict_types=1);

namespace App\Relating\Snapshot\View;

final readonly class RelationshipSidePanelView extends RelationAbstractArrayView
{
    public static function expectedKeys(): array
    {
        return ['relationshipId', 'summary', 'nextActions', 'signals'];
    }
}
