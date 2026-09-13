<?php

declare(strict_types=1);

namespace App\Service;

use App\Snapshot\View\NextBestActionView;

interface NextBestActionServiceInterface
{
    /** @return list<NextBestActionView> */
    public function suggestNextActionsForRelationship(string $relationshipReference): array;
}
