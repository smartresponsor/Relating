<?php

declare(strict_types=1);

namespace App\Relating\Snapshot\View;

final readonly class RelationNeighborReferenceView extends RelationAbstractArrayView
{
    protected static function surfaceName(): string
    {
        return 'neighbor.reference';
    }

    public static function expectedKeys(): array
    {
        return ['component', 'kind', 'reference', 'label'];
    }
}
