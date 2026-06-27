<?php

declare(strict_types=1);

namespace App\View;

final readonly class LeadConversionView extends AbstractArrayView
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
