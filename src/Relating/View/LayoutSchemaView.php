<?php

declare(strict_types=1);

namespace App\Relating\View;

final readonly class LayoutSchemaView extends AbstractArrayView
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
