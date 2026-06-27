<?php

declare(strict_types=1);

namespace App\Relating\View;

final readonly class RelatingViewDefinitionView extends AbstractArrayView
{
    public static function expectedKeys(): array
    {
        return ['code', 'type', 'filters', 'sorts', 'columns'];
    }
}
