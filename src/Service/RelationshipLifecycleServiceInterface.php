<?php

declare(strict_types=1);

namespace App\Relating\Service;

use App\Relating\Entity\Relationship;

interface RelationshipLifecycleServiceInterface
{
    public function moveRelationshipToActiveStage(Relationship $relationship): void;

    public function closeRelationshipWithReason(Relationship $relationship, string $reason): void;
}
