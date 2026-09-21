<?php

declare(strict_types=1);

namespace App\Relating\Snapshot\View;

final readonly class RelationRelatingFieldDefinitionView extends RelationAbstractArrayView
{
    public static function expectedKeys(): array
    {
        return ['objectCode', 'fieldCode', 'fieldType', 'required'];
    }
}
