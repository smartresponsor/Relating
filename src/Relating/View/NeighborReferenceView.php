<?php

declare(strict_types=1);

namespace App\Relating\View;

final readonly class NeighborReferenceView extends AbstractArrayView
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
