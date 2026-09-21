<?php

declare(strict_types=1);

namespace App\Relating\Snapshot\View;

final readonly class RelationAttributionView extends RelationAbstractArrayView
{
    public static function expectedKeys(): array
    {
        return ['target', 'firstTouch', 'lastTouch', 'touches'];
    }
}
