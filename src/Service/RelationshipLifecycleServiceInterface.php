<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Entity\RelationshipEntity;

interface RelationshipLifecycleServiceInterface
{
    public function moveRelationshipToActiveStage(RelationshipEntity $relationship): void;

    public function closeRelationshipWithReason(RelationshipEntity $relationship, string $reason): void;
}
