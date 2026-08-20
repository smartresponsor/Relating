<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Lead;

interface VendorLeadReadServiceInterface
{
    /** @return list<Lead> */
    public function leadsForVendor(string $vendorReference): array;
}
