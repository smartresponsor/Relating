<?php

declare(strict_types=1);

namespace App\Relating\View;

final readonly class RelatingFieldDefinitionView extends AbstractArrayView
{
    public static function expectedKeys(): array
    {
        return ['objectCode', 'fieldCode', 'fieldType', 'required'];
    }
}
