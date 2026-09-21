<?php

declare(strict_types=1);

namespace App\Relating\Snapshot\View;

final readonly class RelationOpportunityRiskProjectionView extends RelationAbstractArrayView
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
