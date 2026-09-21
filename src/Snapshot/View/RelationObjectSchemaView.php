<?php

declare(strict_types=1);

namespace App\Relating\Snapshot\View;

final readonly class RelationObjectSchemaView extends RelationAbstractArrayView
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
