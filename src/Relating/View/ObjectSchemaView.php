<?php

declare(strict_types=1);

namespace App\Relating\View;

final readonly class ObjectSchemaView extends AbstractArrayView
{
    protected static function surfaceName(): string
    {
        return 'metadata.schema';
    }

    public static function expectedKeys(): array
    {
        return ['objectCode', 'fields', 'relationships', 'views'];
    }
}
