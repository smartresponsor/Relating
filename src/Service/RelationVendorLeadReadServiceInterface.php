<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Entity\RelationLeadEntity;

interface RelationVendorLeadReadServiceInterface
{
    /** @return list<RelationLeadEntity> */
    public function leadsForVendor(string $vendorReference): array;
}
