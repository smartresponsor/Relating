<?php

declare(strict_types=1);

namespace App\Relating\Snapshot\View;

final readonly class RelationRelatingViewDefinitionView extends RelationAbstractArrayView
{
    public static function expectedKeys(): array
    {
        return ['code', 'type', 'filters', 'sorts', 'columns'];
    }
}
