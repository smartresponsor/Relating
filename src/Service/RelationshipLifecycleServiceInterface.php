<?php

declare(strict_types=1);

namespace App\Service;

use App\Entity\Relationship;

interface RelationshipLifecycleServiceInterface
{
    public function moveRelationshipToActiveStage(Relationship $relationship): void;

    public function closeRelationshipWithReason(Relationship $relationship, string $reason): void;
}
