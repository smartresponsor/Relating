<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Snapshot\View\RelationNextBestActionView;

interface RelationNextBestActionServiceInterface
{
    /** @return list<RelationNextBestActionView> */
    public function suggestNextActionsForRelationship(string $relationshipReference): array;
}
