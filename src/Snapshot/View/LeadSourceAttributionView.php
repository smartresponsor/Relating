<?php

declare(strict_types=1);

namespace App\Snapshot\View;

final readonly class LeadSourceAttributionView extends AbstractArrayView
{
    public static function expectedKeys(): array
    {
        return ['leadId', 'source', 'firstTouch', 'lastTouch'];
    }
}
