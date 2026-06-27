<?php

declare(strict_types=1);

namespace App\Relating\View;

final readonly class OpportunityStageHistoryView extends AbstractArrayView
{
    public static function expectedKeys(): array
    {
        return ['opportunityId', 'history'];
    }
}
