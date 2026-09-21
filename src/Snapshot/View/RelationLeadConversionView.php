<?php

declare(strict_types=1);

namespace App\Relating\Snapshot\View;

final readonly class RelationLeadConversionView extends RelationAbstractArrayView
{
    protected static function surfaceName(): string
    {
        return 'lead.conversion';
    }

    public static function expectedKeys(): array
    {
        return ['leadId', 'conversionStatus', 'vendorReference', 'opportunityReference', 'duplicateCandidates'];
    }
}
