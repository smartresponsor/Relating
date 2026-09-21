<?php

declare(strict_types=1);

namespace App\Relating\Snapshot\View;

final readonly class RelationLeadSourceAttributionView extends RelationAbstractArrayView
{
    public static function expectedKeys(): array
    {
        return ['leadId', 'source', 'firstTouch', 'lastTouch'];
    }
}
