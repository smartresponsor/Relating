<?php

declare(strict_types=1);

namespace App\Relating\Snapshot\View;

final readonly class RelationViewFilterDefinitionView extends RelationAbstractArrayView
{
    public static function expectedKeys(): array
    {
        return ['viewCode', 'filters'];
    }
}
