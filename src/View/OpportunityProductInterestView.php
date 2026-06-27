<?php

declare(strict_types=1);

namespace App\View;

final readonly class OpportunityProductInterestView extends AbstractArrayView
{
    public static function expectedKeys(): array
    {
        return ['opportunityId', 'products'];
    }
}
