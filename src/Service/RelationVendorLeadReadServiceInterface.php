<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Entity\RelationLead;

interface RelationVendorLeadReadServiceInterface
{
    /** @return list<RelationLead> */
    public function leadsForVendor(string $vendorReference): array;
}
