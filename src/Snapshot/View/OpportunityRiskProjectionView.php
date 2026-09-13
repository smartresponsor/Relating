<?php

declare(strict_types=1);

namespace App\Snapshot\View;

final readonly class OpportunityRiskProjectionView extends AbstractArrayView
{
    protected static function surfaceName(): string
    {
        return 'opportunity.risk.projection';
    }

    /**
     * @return list<string>
     */
    public static function expectedKeys(): array
    {
        return ['opportunityRisk'];
    }
}
