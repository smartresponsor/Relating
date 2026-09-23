<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Repository\RelationLeadRepositoryInterface;
use App\Relating\Repository\RelationshipRepositoryInterface;

final readonly class RelationVendorLeadReadService implements RelationVendorLeadReadServiceInterface
{
    public function __construct(
        private RelationshipRepositoryInterface $relationships,
        private RelationLeadRepositoryInterface $leads,
    ) {
    }

    public function leadsForVendor(string $vendorReference): array
    {
        $vendorReference = trim($vendorReference);
        if ('' === $vendorReference) {
            return [];
        }

        $relationship = $this->relationships->relationshipForVendor($vendorReference);
        if (null === $relationship) {
            return [];
        }

        return $this->leads->leadsForRelationship($relationship->id());
    }
}
