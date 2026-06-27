<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\View\NextBestActionView;

interface NextBestActionServiceInterface
{
    /** @return list<NextBestActionView> */
    public function suggestNextActionsForRelationship(string $relationshipReference): array;
}
