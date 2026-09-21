<?php

declare(strict_types=1);

namespace App\Relating\Snapshot\View;

final readonly class RelationCaseThreadView extends RelationAbstractArrayView
{
    public static function expectedKeys(): array
    {
        return ['caseId', 'thread'];
    }
}
