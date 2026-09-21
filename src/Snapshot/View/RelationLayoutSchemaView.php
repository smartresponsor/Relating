<?php

declare(strict_types=1);

namespace App\Relating\Snapshot\View;

final readonly class RelationLayoutSchemaView extends RelationAbstractArrayView
{
    protected static function surfaceName(): string
    {
        return 'metadata.layout';
    }

    public static function expectedKeys(): array
    {
        return ['layoutCode', 'surface', 'sections', 'fields'];
    }
}
